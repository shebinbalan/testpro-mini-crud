<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',  // Ensure the file is an image and max size 2MB
        ]);
    
        try {
            // Store the uploaded image in 'public/categories'
            $imagePath = $request->file('image')->store('categories', 'public');
    
            // Save the category using Eloquent
            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'image' => $imagePath,  // Store image path
            ]);
    
            return redirect('categories')->with('success', 'Category Added Successfully');
        } catch (\Exception $e) {
            return redirect('categories')->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $category = Category::find($id); // Use $id instead of 'id'
    
        if (!$category) {
            return redirect('categories')->with('error', 'Category not found.');
        }
    
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    try {
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            // Store new image
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect('categories')->with('success', 'Category Updated Successfully');
    } catch (\Exception $e) {
        return redirect('categories')->with('error', 'Error: ' . $e->getMessage());
    }
}



public function destroy($id)
{
    try {
        $category = Category::findOrFail($id);

        // Delete the image if it exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category from the database
        $category->delete();

        return redirect('categories')->with('success', 'Category deleted successfully.');
    } catch (\Exception $e) {
        return redirect('categories')->with('error', 'Error: ' . $e->getMessage());
    }
}



}
