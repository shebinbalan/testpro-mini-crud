<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::with('category')->get();

     return view('admin.product.index', compact('products'));
}

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Add this
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug', // Changed from categories to products
            'price' => 'required|numeric', // Add this
            'description' => 'required|string',
            'image' => 'required|image|max:2048'
        ]);
    
        try {
            // Store the uploaded image in 'public/categories'
            $imagePath = $request->file('image')->store('products', 'public');
    
            // Save the category using Eloquent
            $product = Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imagePath,  // Store image path
            ]);
    
            return redirect('products')->with('success', 'Product Added Successfully');
        } catch (\Exception $e) {
            return redirect('products')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id); // Use $id instead of 'id'
    
        if (!$product) {
            return redirect('products')->with('error', 'Product not found.');
        }
    
        return view('admin.product.edit', compact('categories','product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id, // Add exception for current product
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048' // Changed to nullable since it's not required on update
        ]);
    
        try {
            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
    
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                // Store new image
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }
    
            $product->save(); // Changed from $category to $product
    
            return redirect('products')->with('success', 'Product Updated Successfully'); // Changed from categories
        } catch (\Exception $e) {
            return redirect('products')->with('error', 'Error: ' . $e->getMessage()); // Changed from categories
        }
    }

    public function destroy($id)
{
    try {
        $product = Product::findOrFail($id);

        // Delete the image if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the category from the database
        $product->delete();

        return redirect('products')->with('success', 'Category deleted successfully.');
    } catch (\Exception $e) {
        return redirect('products')->with('error', 'Error: ' . $e->getMessage());
    }
}
}
