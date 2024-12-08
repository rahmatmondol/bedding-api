<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Images;
use App\Models\Skills;
use App\Models\Locations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Wishlist;

class ServicesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerId = request()->query('customer_id');
        $subCategoryId = request()->query('subcategory_id');
        $categoryId = request()->query('category_id');
        $location = request()->query('location');
        $latitude = request()->query('latitude');
        $longitude = request()->query('longitude');
        $priceType = request()->query('priceType');
        $currency = request()->query('currency');
        $status = request()->query('status') ?? 'active';
        $level = request()->query('level');
        $featured = request()->query('featured');
        $search = request()->query('search');
        try {
            // Build the query with optional filters
            $query = Services::with(['images', 'skills', 'customer'])
                ->when($customerId, fn($q) => $q->where('user_id', $customerId))
                ->when($search, fn($q) => $q->where('title', 'LIKE', "%{$search}%"))
                ->when($subCategoryId, fn($q) => $q->where('sub_category_id', $subCategoryId))
                ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
                ->when($priceType, fn($q) => $q->where('priceType', $priceType))
                ->when($currency, fn($q) => $q->where('currency', $currency))
                ->when($status, fn($q) => $q->where('status', $status))
                ->when($level, fn($q) => $q->where('level', $level))
                ->when($featured, fn($q) => $q->where('is_featured', $featured));

            // Execute the query and retrieve the services
            $services = $query->orderBy('created_at', 'desc')->get();

            return ResponseHelper::success('All Services', $services);
        } catch (\Exception $e) {
            // Provide a more descriptive error response if query fails
            return ResponseHelper::error('Failed to retrieve services: ' . $e->getMessage(), 500);
        }

    }

        /**
     * Display a listing of the resource.
     */
    public function get_services()
    {
       // Retrieve query parameters with default values
        $filters = [
            'customer_id' => request()->query('customer_id'),
            'subcategory_id' => request()->query('subcategory_id'),
            'category_id' => request()->query('category_id'),
            'location' => request()->query('location'),
            'latitude' => request()->query('latitude'),
            'longitude' => request()->query('longitude'),
            'priceType' => request()->query('priceType'),
            'priceType' => request()->query('priceType'),
            'currency' => request()->query('currency'),
            'status' => request()->query('status', 'active'),
            'level' => request()->query('level'),
            'featured' => request()->query('featured'),
            'search' => request()->query('search'),
            'skills' => request()->query('skills'),
            'category_slug' => request()->query('category_slug'),
        ];

        // Pagination parameters
        $perPage = (int) request()->query('per_page', 9); // Items per page, default 10

        try {
            // Build the query
            $query = Services::with(['images', 'skills', 'customer'])
                ->where('postType', 'Service')
                ->when($filters['customer_id'], fn($q, $customerId) => $q->where('user_id', $customerId))
                ->when($filters['location'], fn($q, $location) => $q->where('location', $location))
                ->when($filters['latitude'], fn($q, $latitude) => $q->where('latitude', $latitude))
                ->when($filters['longitude'], fn($q, $longitude) => $q->where('longitude', $longitude))
                ->when($filters['skills'], fn($q, $skills) => $q->whereHas('skills', fn($q) => $q->whereIn('skills.id', explode(',', $skills))))
                ->when($filters['search'], fn($q, $search) => $q->where('title', 'LIKE', "%{$search}%"))
                ->when($filters['subcategory_id'], fn($q, $subCategoryId) => $q->where('sub_category_id', $subCategoryId))
                ->when($filters['category_id'], fn($q, $categoryId) => $q->where('category_id', $categoryId))
                ->when($filters['priceType'], fn($q, $priceType) => $q->where('priceType', $priceType))
                ->when($filters['currency'], fn($q, $currency) => $q->where('currency', $currency))
                ->when($filters['status'], fn($q, $status) => $q->where('status', $status))
                ->when($filters['level'], fn($q, $level) => $q->where('level', $level))
                ->when($filters['featured'], fn($q, $featured) => $q->where('is_featured', $featured))
                ->when($filters['category_slug'], fn($q, $categorySlug) => $q->whereHas('category', fn($q) => $q->where('slug', $categorySlug)));

            // Apply pagination
            $services = $query->orderBy('created_at', 'desc')
                ->paginate($perPage);

            // Return success response with paginated data
            return ResponseHelper::success('All Services', $services);
        } catch (\Exception $e) {
            // Log error and return a detailed error response
            \Log::error('Service retrieval failed', ['error' => $e->getMessage()]);
            return ResponseHelper::error('Failed to retrieve services. Please try again later.', 500);
        }

    }

    public function get_auctions()
    {
       // Retrieve query parameters with default values
        $filters = [
            'customer_id' => request()->query('customer_id'),
            'subcategory_id' => request()->query('subcategory_id'),
            'category_id' => request()->query('category_id'),
            'location' => request()->query('location'),
            'latitude' => request()->query('latitude'),
            'longitude' => request()->query('longitude'),
            'priceType' => request()->query('priceType'),
            'priceType' => request()->query('priceType'),
            'currency' => request()->query('currency'),
            'status' => request()->query('status', 'active'),
            'level' => request()->query('level'),
            'featured' => request()->query('featured'),
            'search' => request()->query('search'),
            'skills' => request()->query('skills'),
            'category_slug' => request()->query('category_slug'),
        ];

        // Pagination parameters
        $perPage = (int) request()->query('per_page', 9); // Items per page, default 10

        try {
            // Build the query
            $query = Services::with(['images', 'skills', 'customer'])
                ->where('postType', 'Auction')
                ->when($filters['customer_id'], fn($q, $customerId) => $q->where('user_id', $customerId))
                ->when($filters['location'], fn($q, $location) => $q->where('location', $location))
                ->when($filters['latitude'], fn($q, $latitude) => $q->where('latitude', $latitude))
                ->when($filters['longitude'], fn($q, $longitude) => $q->where('longitude', $longitude))
                ->when($filters['skills'], fn($q, $skills) => $q->whereHas('skills', fn($q) => $q->whereIn('skills.id', explode(',', $skills))))
                ->when($filters['search'], fn($q, $search) => $q->where('title', 'LIKE', "%{$search}%"))
                ->when($filters['subcategory_id'], fn($q, $subCategoryId) => $q->where('sub_category_id', $subCategoryId))
                ->when($filters['category_id'], fn($q, $categoryId) => $q->where('category_id', $categoryId))
                ->when($filters['priceType'], fn($q, $priceType) => $q->where('priceType', $priceType))
                ->when($filters['currency'], fn($q, $currency) => $q->where('currency', $currency))
                ->when($filters['status'], fn($q, $status) => $q->where('status', $status))
                ->when($filters['level'], fn($q, $level) => $q->where('level', $level))
                ->when($filters['featured'], fn($q, $featured) => $q->where('is_featured', $featured))
                ->when($filters['category_slug'], fn($q, $categorySlug) => $q->whereHas('category', fn($q) => $q->where('slug', $categorySlug)));

            // Apply pagination
            $services = $query->orderBy('created_at', 'desc')
                ->paginate($perPage);

            // Return success response with paginated data
            return ResponseHelper::success('All Auctions', $services);
        } catch (\Exception $e) {
            // Log error and return a detailed error response
            \Log::error('Service retrieval failed', ['error' => $e->getMessage()]);
            return ResponseHelper::error('Failed to retrieve services. Please try again later.', 500);
        }

    }

    
    public function services_archive()
    {

        $categories = Categories::all();
        $subcategories = Subcategories::all();
        $skills = Skills::all();

        return view('services-archive', compact('categories', 'subcategories', 'skills'));

    }


    public function auction_archive()
    {

        $categories = Categories::all();
        $subcategories = Subcategories::all();
        $skills = Skills::all();

        return view('auction-archive', compact('categories', 'subcategories', 'skills'));

    }


    public function services()
    {
        $categoryId = request()->query('category');

        $servicesQuery = Services::where('user_id', auth()->user()->id)
            ->with('images');

        if ($categoryId) {
            $servicesQuery->where('category_id', $categoryId);
        }

        $services = $servicesQuery->paginate(8)->toArray();


        $categories = Categories::all();
        return view('services.index', compact('services', 'categories'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        $skills = Skills::all();
        $locations = Locations::all();
        return view('user.service.create', compact('categories', 'skills', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_auction()
    {
        $categories = Categories::all();
        $skills = Skills::all();
        $locations = Locations::all();
        return view('user.service.create-auction', compact('categories', 'skills', 'locations'));
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
            $service->location      = $request->location_name;
            $service->latitude      = $request->latitude;
            $service->postType      = $request->postType ?? 'Service';
            $service->skills        = $request->skills;
            $service->longitude     = $request->longitude;
            $service->is_featured   = $request->is_featured ? true : false;
            
            if($request->level){
                $service->level = $request->level;
            }

            $service->save();

            if($request->customer_id){
                $service->customer()->associate($request->customer_id);
            }else{
                $service->customer()->associate($request->user());
            }
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
                $images = $request->file('images');

                // dd($images);

                foreach ($images as $imageFile) {
                    if ($imageFile instanceof UploadedFile) {
                        $originalName = $imageFile->getClientOriginalName();
                        $filename = time() . '_' . $originalName;
                        $imageFile->move('uploads/service/', $filename);

                        $image = new Images([
                            'path' => url('uploads/service/' . $filename),
                            'name' => $originalName,
                        ]);

                        $service->images()->save($image);
                    }
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
    public function show($slug)
    {
        return view('pages.service.details');
    }

     /**
     * Display the specified resource.
     */
    public function showSingle($id)
    {
        try {
            $service = Services::with('images', 'skills', 'category', 'customer')->findOrFail($id);
            return ResponseHelper::success('Service Details', $service);
        } catch (\Exception $e) {
            // Provide a more descriptive error response if query fails
            return ResponseHelper::error('Service Details not found: ' . $e->getMessage(), 500);
        }
    }

    public function singleAuction($id)
    {
        try {
            $service = Services::with('images', 'skills', 'category', 'customer')->findOrFail($id);
            return ResponseHelper::success('Service Details', $service);
        } catch (\Exception $e) {
            // Provide a more descriptive error response if query fails
            return ResponseHelper::error('Service Details not found: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Categories::all();
        $subcategories = SubCategories::all();
        $skills = Skills::all();
        $service = Services::with('images')->findOrFail($id);
        return view('user.service.edit', compact('service', 'categories', 'skills', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicesRequest $request, Services $services)
    {
        $service = Services::where('id', $request->id)->firstOrFail();
        if(!$service){
            return ResponseHelper::error('Service Not Found', 404);
        }

        DB::beginTransaction();
        // dd($request->all());
        try {

            // update service
            $service->title         = $request->title;
            $service->slug          = Str::slug($request->title);
            $service->description   = $request->description;
            $service->price         = $request->price;
            $service->priceType     = $request->priceType;
            $service->currency      = $request->currency;
            $service->skills        = $request->skills;
            $service->location      = $request->location_name;
            $service->latitude      = $request->latitude;
            $service->longitude     = $request->longitude;
            
            if($request->level){
                $service->level = $request->level;
            }

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
                 //delete old images
                 foreach ($service->images as $image) {
                    $relativePath = parse_url($image->path, PHP_URL_PATH);
                    if (file_exists(public_path($relativePath))) {
                        unlink(public_path($relativePath)); // Deletes the file
                    }
                    $image->delete(); // Removes the record from the database
                }
                
                //if have multiple images
                $images = $request->file('images');

                foreach ($images as $imageFile) {
                    if ($imageFile instanceof UploadedFile) {
                        $originalName = $imageFile->getClientOriginalName();
                        $filename = time() . '_' . $originalName;
                        $imageFile->move('uploads/service/', $filename);

                        $image = new Images([
                            'path' => url('uploads/service/' . $filename),
                            'name' => $originalName,
                        ]);

                        $service->images()->save($image);
                    }
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

            return ResponseHelper::success('Service Updated Successfully', $service);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();

            return ResponseHelper::error('Service Updated failed: ' . $e->getMessage(), 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        
    }
}


