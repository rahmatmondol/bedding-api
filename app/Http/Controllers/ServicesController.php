<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\Subcategories;
use App\Models\Images;
use App\Models\Skills;
use App\Models\Locations;
use Illuminate\Http\UploadedFile; // Import \Illuminate\Http\UploadedFile
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategoryId = request()->query('subcategory');
        $categoryId = request()->query('category');
        $location = request()->query('location');
        $latitude = request()->query('latitude');
        $longitude = request()->query('longitude');
        $priceType = request()->query('priceType');
        $currency = request()->query('currency');
        $status = request()->query('status');
        $level = request()->query('level');
        $featured = request()->query('featured');

        try {
            // Build the query with optional filters
            $query = Services::with(['images', 'skills'])
                ->when($subCategoryId, fn($q) => $q->where('sub_category_id', $subCategoryId))
                ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
                ->when($priceType, fn($q) => $q->where('priceType', $priceType))
                ->when($currency, fn($q) => $q->where('currency', $currency))
                ->when($status, fn($q) => $q->where('status', $status))
                ->when($level, fn($q) => $q->where('level', $level))
                ->when($featured, fn($q) => $q->where('is_featured', $featured));

            // Execute the query and retrieve the services
            $services = $query->get();

            return ResponseHelper::success('All Services', $services);
        } catch (\Exception $e) {
            // Provide a more descriptive error response if query fails
            return ResponseHelper::error('Failed to retrieve services: ' . $e->getMessage(), 500);
        }

    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicesRequest $request)
    {
        DB::beginTransaction();
        // dd($request->all());
        try {

            // Create service
            $service = new Services;
            $service->title         = $request->title;
            $service->slug          = Str::slug($request->title);
            $service->description   = $request->description;
            $service->price         = $request->price;
            $service->priceType     = $request->priceType;
            $service->currency      = $request->currency;
            $service->level         = $request->level;
            $service->location      = $request->location_name;
            $service->latitude      = $request->latitude;
            $service->longitude     = $request->longitude;
           
            $service->save();

            // attach to user
            $service->customer()->associate($request->user());
            $service->save();

            // attach category to service
            if (isset($request->category_id) && $request->category_id > 0) {
                $category = Categories::find($request->category_id);
                if ($category) {
                    $service->category()->associate($category->id);
                    $service->save();
                } else {
                    DB::rollBack();
                    return ResponseHelper::error('Category Not Found', 404);
                }
            }

            // attach subcategory to service
            if (isset($request->subCategory_id) && $request->subCategory_id > 0) {
                $subcategory = Subcategories::find($request->subCategory_id);
                if ($subcategory) {
                    $service->sub_category_id = $subcategory->id;
                    $service->save();
                } else {
                    DB::rollBack();
                    return ResponseHelper::error('SubCategory Not Found', 404);
                }
            }

            
            // attach image to service
            if ($request->hasFile('images')) {
                //if have multiple images
                if ($request->file('images') instanceof UploadedFile) {
                    $originalName = $request->file('images')->getClientOriginalName();
                    $filename = time() . '_' . $originalName;
                    $request->file('images')->move('uploads/service/', $filename);

                    $image = new Images([
                        'path' => url('uploads/service/' . $filename),
                        'name' => $originalName,
                    ]); 

                    $service->images()->save($image);
                }
               
            }

            // attach multiple skills to service
            if (!empty($request->skills_ids)) {
                if (!is_array($request->skills_ids)) {
                    $request->skills_ids = explode(',', $request->skills_ids);
                }
               foreach ($request->skills_ids as $skill) {
                   $service->skills()->attach($skill);
               }
            }

            // If everything goes well, commit the transaction
            DB::commit();

            return ResponseHelper::success('Service Created Successfully', $service);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();

            return ResponseHelper::error('Service Created failed: ' . $e->getMessage(), 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicesRequest $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        //
    }
}


