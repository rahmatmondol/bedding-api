<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Images;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // send all categories to the api with 
        try {
            $categories = Categories::get();
            return ResponseHelper::success('All Categories',$categories);
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
    public function store(StoreCategoriesRequest $request)
    {
        try {
            $categoryData = [
                'name' => $request->name,
                'description' => $request->description ?? '',
                'slug' => Str::slug($request->name),
                'status' => $request->status ?? 'active',
            ];

            $category = Categories::create($categoryData);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->move('uploads/categories/', $filename);

                $category->image = url('uploads/categories/' . $filename);
                
                $category->save();
            }
    
            $category = Categories::with(['image:id,path,name'])->findOrFail($category->id);
            return ResponseHelper::success('Category Created Successfully', $category);

        } catch (\BadMethodCallException $e) {
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // show category details
        try {
            $categories = Categories::findOrFail($id)->with(['image:id,path,name'])->first();
            return ResponseHelper::success('Category Details', $categories);
        } catch (\Exception $e) {
            return ResponseHelper::error('Category Not Found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        // edit category details
        return ResponseHelper::success('Category Details', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, Categories $categories)
    {
        // update category details
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        $categories->name = $validated['name'];
        $categories->description = $validated['description'];
        $categories->slug = $validated['slug'];
        $categories->status = $validated['status'];
        $categories->save();
        return ResponseHelper::success('Category Updated Successfully', $categories);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        // delete category
        $categories->delete();
        return ResponseHelper::success('Category Deleted Successfully');
    }
}
