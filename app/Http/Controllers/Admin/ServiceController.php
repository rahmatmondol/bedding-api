<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories as Category;
use App\Models\SubCategories;
use App\Models\user as Customer;
use App\Models\user as Provider;
use App\Models\Services as Service;
use App\Models\Skills;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use PHPUnit\Exception;

class ServiceController extends Controller
{
    //
    public function serviceAdd(){
        $categories = Category::get();
        $providers = Customer::role('customer')->get();
        $zones = Zone::get();
        $skills = Skills::all();
        
        // return $customers;
        return view('admin.page.service.add',compact('categories','providers','zones', 'skills'));
    }


    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'name' => 'required|string',
                'category_id' => 'required|integer|exists:categories,id',
                'subcategory_id'=>'required|integer|exists:categories,id',
                'customer_id' => 'required|integer|exists:customers,id',
                'zone_id'=>'required|integer|exists:zones,id',
                'price' => 'required|numeric',
                'price_type' => 'required|in:fixed,negotiable',
                'level' => 'required|in:entry,intermediate,expert',
                'currency' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'description' => 'required|string',
                'is_featured' => 'nullable',
            ]);

            $lat = $request->latitude;
            $lng = $request->longitude;
            $commotion = $request->input('price') * 0.10;
            $provider_amount = $request->input('price') - $commotion;

            $zones = Zone::whereId($request->zone_id)->get();


            if ($zones->isEmpty()) {
                Session::flash('toaster', ['status' => 'error', 'message' => 'Service already exists']);
                return back();
            }

            // Find the service by ID
            $service = Service::findOrFail($id);

            // Update the service with the request data
            $service->update([
                'name' => $request->name,
                'zone_id' => $zones,
                'category_id' => $request->subcategory_id,
                'customer_id' => $request->customer_id,
                'price_type' => $request->price_type,
                'price' => $request->price,
                'level' => $request->level,
                'currency' => $request->currency,
                'provider_amount' => $provider_amount,
                'commotion' => $commotion,
                'description' => $request->description,
                'address' => $request->address,
                'skill' => $request->skill,

                'location' => $lat.','.$lng,

            ]);

            // If there's a new image, handle the file upload here.
            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $destinationPath = public_path('/assets/images/service/');
                $postImage = "service_$service->id.png";
                $fullPath = $destinationPath . $postImage;

                // Check if the directory exists, if not create it
                if (!file_exists($destinationPath)) {
                    if (!mkdir($destinationPath, 0777, true) && !is_dir($destinationPath)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $destinationPath));
                    }
                }

                // Save the image to the specified path
                Image::make($image)->resize(200, 200)->save($fullPath);
                $service->image = '/assets/images/service/'.$postImage;
                $service->save();
            }
            Session::flash('toaster', ['status' => 'success', 'message' => 'Service update successfully.']);

            // Redirect back with a success message
            return redirect()->route('list.service');
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('toaster', [
                    'status' => 'error',
                    'message' => 'There were some validation errors.',
                    'errors' => $e->errors()
                ]);
        }
        // Validate the request data
    }



    public function Store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'category_id' => 'required',
                'subcategory_id'=>'required',
                'provider_id' => 'required',
                'zone_id'=>'required',
                'price' => 'required|numeric',
                'price_type' => 'required',
                'duration' => 'required|string',
                'discount' => 'required|numeric',
                'image' => 'required',
                'short_description' => 'required|string',
                'long_description' => 'required|string',
                'is_featured' => 'nullable',
            ]);


            $serviceExists = Service::where('name', $validatedData['name'])
                ->whereCategoryId('subcategory_id')
                ->where('provider_id', $request->provider)
                ->exists();



            if ($serviceExists) {
                Session::flash('toaster', ['status' => 'error', 'message' => 'Service already exists']);
                return back();
            }

            // Create a new service instance
            $service = new Service();
            $service->name = $validatedData['name'];
            $service->category_id = $validatedData['subcategory_id'];
            $service->provider_id = $validatedData['provider_id'];
            $service->zone_id = $validatedData['zone_id'];
            $service->price = $validatedData['price'];
            $service->type = $validatedData['price_type'];
            $service->duration = $validatedData['duration'];
            $service->discount = $validatedData['discount'];
            $service->status = 1;
            $service->short_description = $validatedData['short_description'];
            $service->long_description = $validatedData['long_description'];
            $service->is_featured = $request->has('is_featured') ? 1 : 0;





            $service->added_by = auth()->user()->id; // Assuming the authenticated user is adding the service

            // Save the service
            $service->save();
            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $destinationPath = public_path('assets/images/service/');
                $postImage = "service_$service->id.png";
                $fullPath = $destinationPath . $postImage;

                // Check if the directory exists, if not create it
                if (!file_exists($destinationPath)) {
                    if (!mkdir($destinationPath, 0777, true) && !is_dir($destinationPath)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $destinationPath));
                    }
                }

                // Save the image to the specified path
                Image::make($image)->resize(200, 200)->save($fullPath);
                $service->image = '/assets/images/service/'.$postImage;
                $service->save();
            }

            // Optionally, you can redirect or return a response
            Session::flash('toaster', ['status' => 'success', 'message' => 'Service saved successfully']);
            return redirect()->route('list.service');
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('toaster', [
                    'status' => 'error',
                    'message' => 'There were some validation errors.',
                    'errors' => $e->errors()
                ]);
        }


    }
    public function list(){
        $services = Service::with('category','customer','images')->get();
        // return  $services;
        return view('admin.page.service.list',compact('services'));
    }
    public function destroy( $id)
    {
        try {
            // Find the category by ID
            $service = Service::findOrFail($id);

            foreach ($service->images as $image) {
                $relativePath = parse_url($image->path, PHP_URL_PATH);
                if (file_exists(public_path($relativePath))) {
                    unlink(public_path($relativePath)); // Deletes the file
                }
                $image->delete(); // Removes the record from the database
            }
            $service->delete();
            Session::flash('toaster', ['status' => 'success', 'message' => 'Service deleted successfully!']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the deletion process
            Session::flash('toaster', ['status' => 'error', 'message' => 'Failed to delete Service!']);

        }

        return redirect()->route('admin.list.service');
    }

    public function details($id){
        $service = Service::with(['customer','bettings.provider'])->where('id',$id)->first();

//        $extra_services = $service->extra_services;
        $reviews = $service->bettings;

//        return $service;

        return view('admin.page.service.details', [
            'service' => $service,
            'reviews' => $reviews
        ]);
    }

    public function serviceEidt($id){
        $service = Service::with('images')->findOrFail($id);
        $zones = Zone::all();
        $categories = Category::get();
        $providers = Customer::role('customer')->get();
        $subcategories = SubCategories::get();
        // return $categories;
        return view('admin.page.service.edit',compact('service','zones','categories','subcategories','providers'));
    }

    public function getServicesByZone($zone){
        $categories = Service::whereJsonContains('zone', ['id' => $zone])
            // Check if zone_id is in the 'zone' column
            ->get();

        return response()->json($categories);

    }
    public function getCategoriesByZone()
    {

        $categories = Category::where('parent_id', 0)
//            ->whereRaw("FIND_IN_SET($zone, zone_id)") // Check if zone_id is in the 'zone' column
            ->get();
        return response()->json($categories);
    }
    public function getProvidersByZone()
    {
        $providers = Customer::get();
        return response()->json($providers);
    }

}
