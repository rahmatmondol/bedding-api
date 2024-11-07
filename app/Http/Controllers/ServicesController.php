<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use App\Helpers\ResponseHelper;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategoryId = request()->query('subcategory_id');
        $categoryId = request()->query('category_id');
        
        try {
            // Build the query with optional filters for subcategory and category IDs
            $query = Services::with(['images','skills'])
                ->when($subCategoryId, function ($q) use ($subCategoryId) {
                    return $q->where('sub_category_id', $subCategoryId);
                })
                ->when($categoryId, function ($q) use ($categoryId) {
                    return $q->where('category_id', $categoryId);
                });
    
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicesRequest $request)
    {
        //
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
