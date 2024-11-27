<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategories;
use App\Models\Categories as Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    //
    public function subcategoryAdd(Request $request){
        $categories = Category::get();
        return view('admin.page.subcategory.add',compact('categories'));
    }

    public function subcategorylist(Request $request){
        $categories = SubCategories::with('category')->get();

        return view('admin.page.subcategory.list',compact('categories'));
    }
    public function subCategoryStore(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|unique:sub_categories,name',
                'category_id' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the validation rules for the image if needed
            ]);


            // Create a new category
            $category = new SubCategories;
            $category->name = $request->input('name');
            $category->category_id = $request->input('category_id');
            $category->slug = Str::slug($request->input('name'));
            $category->description = $request->input('description') ?? '';
            $category->save();


            // Add more category properties as needed
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->move('uploads/categories/', $filename);

                $category->image = url('uploads/categories/' . $filename);
                
                $category->save();
            }

            // Redirect to a success page or return a response
            return redirect()->route('admin.list.subcategory')
                ->with('toaster', ['status' => 'success', 'message' => 'Category added successfully']);

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

    public function edit($id){
        $category = SubCategories::findOrFail($id); // Use firstOrFail() to get a single category by its ID
        $categories = Category::get();

        return view('admin.page.subcategory.edit',compact('categories','category'));
    }
    public function update(Request $request, $id)
    {
        try {

            // Find the category by ID
            $category = SubCategories::findOrFail($id);

            // Validate the form data
            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the validation rules for the image if needed
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.subcategory.edit', $id)
                    ->with('toaster', [
                        'status' => 'error',
                        'message' => 'Image must be in jpeg,png,jpg,gif,svg',
                    ]);
            }

            // Update the category name if provided
            if ($request->has('name')) {
                $category->name = $request->name;
            }
            if ($request->has('category_id')) {
                $category->category_id = $request->category_id;
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

            return redirect()->route('admin.list.subcategory')->with('toaster', [
                'status' => 'success',
                'message' => 'Sub Category updated successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('toaster', [
                    'status' => 'error',
                    'message' => 'Failed to update Sub Category.',
                    'errors' => $e->errors()
                ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            // Find the category by ID
            $category = SubCategories::findOrFail($id);

            $relativePath = parse_url($category->image, PHP_URL_PATH);
            if (file_exists(public_path($relativePath))) {
                unlink(public_path($relativePath)); // Deletes the file
            }
            $category->delete();

            Session::flash('toaster', ['status' => 'success', 'message' => 'Category deleted successfully!']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the deletion process
            Session::flash('toaster', ['status' => 'error', 'message' => 'Failed to delete category!']);
        }

        return redirect()->route('admin.list.subcategory');
    }
}
