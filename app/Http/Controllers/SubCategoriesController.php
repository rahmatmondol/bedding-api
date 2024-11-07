<?php

namespace App\Http\Controllers;

use App\Models\SubCategories;
use App\Http\Requests\StoreSubCategoriesRequest;
use App\Http\Requests\UpdateSubCategoriesRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Images;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        // send all sub categories to the api with
        $categoryId = request()->query('category_id');
        try {
            $query = SubCategories::when($categoryId, function ($q) use ($categoryId) {
                return $q->where('category_id', $categoryId);
            });
            $categories = $query->get();
            return ResponseHelper::success('All SubCategories',$categories);
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage(), 500);
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
    public function store(StoreSubCategoriesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         // show category details
         try {
            $categories = SubCategories::findOrFail($id)->with(['image:id,path,name'])->first();
            return ResponseHelper::success('SubCategories Details', $categories);
        } catch (\Exception $e) {
            return ResponseHelper::error('SubCategories Not Found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategories $subCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoriesRequest $request, SubCategories $subCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategories $subCategories)
    {
        //
    }
}
