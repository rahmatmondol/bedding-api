<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Categories as Category;
use App\Models\SubCategories;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function categoryAdd(Request $request){
        // $zones = Zone::get(['name','id']);
        return view('admin.page.category.add');
    }
    public function categorylist(Request $request)
    {
        $categories = Category::get()->load('subCategories');
        // return $categories;
        return view('admin.page.category.list', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // Check if the category already exists in the provided zone
            $existingCategory = Category::where('name', $request->name)->first();

            if ($existingCategory) {
                Session::flash('toaster', ['status' => 'error', 'message' => ' Already exist in  category']);
                return redirect()->route('admin.list.category');
            }

            $validatedData = $request->validate([
                'name' => 'required|unique:categories,name',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the validation rules for the image if needed
            ]);

            // Create a new category
            $categoryData = [
                'name' => $request->name,
                'description' => $request->description ?? '',
                'slug' => Str::slug($request->name),
                'status' => $request->status ?? 'active',
            ];

            $category = Category::create($categoryData);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->move('uploads/categories/', $filename);

                $category->image = url('uploads/categories/' . $filename);
                
                $category->save();
            }

            // Redirect to a success page or return a response
            $message = 'Category added successfully';
            $status = 'success';

            return redirect()->route('admin.list.category')
                ->with('toaster', ['status' => $status, 'message' => $message]);
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
        // Validate the form data

    }


    public function destroy(Request $request, $id)
    {
        try {
            // Find the category by ID
            $category = Category::findOrFail($id);

            $relativePath = parse_url($category->image, PHP_URL_PATH);
            if (file_exists(public_path($relativePath))) {
                unlink(public_path($relativePath)); // Deletes the file
            }

            // Delete associated subcategories images
            SubCategories::where('category_id', $category->id)
                ->get()
                ->each(function ($subcategory) {
                    $relativePath = parse_url($subcategory->image, PHP_URL_PATH);
                    if (file_exists(public_path($relativePath))) {
                        unlink(public_path($relativePath)); // Deletes the file
                    }
                });

            // Delete the category and its subcategories (if any)
            $category->delete();

            Session::flash('toaster', ['status' => 'success', 'message' => 'Category deleted successfully!']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the deletion process
            Session::flash('toaster', ['status' => 'error', 'message' => 'Failed to delete category!']);
        }

        return redirect()->route('admin.list.category');
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id); // Use firstOrFail() to get a single category by its ID
        return view('admin.page.category.edit')->with(compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the category by ID
            $category = Category::findOrFail($id);

            // Validate the form data
            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the validation rules for the image if needed
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.edit.category', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            // Update the category name if provided
            if ($request->has('name')) {
                $category->name = $request->name;
            }

            // Upload and update the image file if provided
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                $relativePath = parse_url($category->image, PHP_URL_PATH);

                if (file_exists(public_path($relativePath))) {
                    unlink(public_path($relativePath)); // Deletes the file
                }

                $image = $request->file('image');
                $originalName = $image->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                $image->move('uploads/categories/', $filename);
                $category->image = url('uploads/categories/' . $filename);
                $category->save();
            }

            // Save the category
            $category->save();

            return redirect()->route('admin.list.category')->with('toaster', [
                'status' => 'success',
                'message' => 'Category updated successfully!',
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update process
            return redirect()->route('admin.edit.category', $id)->with('toaster', [
                'status' => 'error',
                'message' => 'Failed to update category!',
            ]);
        }
    }

    public function getSubcategories($category)
    {
        $subcategories = Category::where('parent_id', $category)->where('parent_id', '!=', 0)->get();

        return response()->json($subcategories);
    }
    public function getCategories($zone)
    {
        $categories = Category::where('zone_id', $zone)->where('parent_id',  0)->get();

        return response()->json($categories);
    }
}
