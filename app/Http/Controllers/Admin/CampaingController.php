<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Categories as Category;
use App\Models\Services as Service;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class CampaingController extends Controller
{
    //
    public function add(){

        $zones = Zone::all();
        $categories = Category::all();
        return view('admin.page.campain.add',compact('zones','categories'));
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'zone_id' => 'required',
                'category_id'=> 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'discount' => 'required|integer',
                'start' => 'required|date',
                'end' => 'required|date|after:start_date',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            if ($request->has('category_id')){
                $validatedData['type']= 'category';
            }
            $validatedData['name'] = $request->name;
            $validatedData['category_id']=$request->category_id;

            $validatedData['zone_id'] = $request->zone_id;
            $validatedData['discount'] = $request->discount;
            $validatedData['start'] = $request->start;
            $validatedData['end'] = $request->end;

            // Create the campaign
            $campaign = Campaign::create($validatedData);
          
             // attach image to service
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $originalName = $image->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $image->move('uploads/campaign/', $filename);
                $campaign->image =url('uploads/campaign/' . $filename);
                $campaign->save();
            }

            Session::flash('toaster', ['status' => 'success', 'message' => 'Campaign created successfully!']);

            return redirect()->route('admin.campaign.list');

        } catch (\Illuminate\Validation\ValidationException $e) {
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

    public function serviceCampaignAdd(Request $request){
        $zones = Zone::all();
        return view('admin.page.campain.service-add',compact('zones'));
    }

    public function destroy($id)
    {
        try {
            // Find the category by ID
            $campaign = Campaign::findOrFail($id);
            $position = strpos($campaign->image, '/assets');

            if ($position !== false) {
                // Extract the part of the path after "/assets"
                $imagePath = substr($campaign->image, $position);

                // Construct the full path to the image file
                $fullImagePath = public_path($imagePath);


                // Check if the image file exists
                if (file_exists($fullImagePath)) {
                    // Delete the image file
                    unlink($fullImagePath);
                }
            }

            // Delete the campaign
            $campaign->delete();

            Session::flash('toaster', ['status' => 'success', 'message' => 'Campaign deleted successfully!']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the deletion process
            Session::flash('toaster', ['status' => 'error', 'message' => 'Failed to delete campaign!']);
        }
        // Find the campaign by ID


        return redirect()->back();
    }

    public function campaignlist()
    {
        $campaigns = Campaign::with('zone')->get();
        return view('admin.page.campain.list',compact('campaigns'));
    }
}
