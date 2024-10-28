<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ensure you have a Product model
use App\Models\Category; // Ensure you have a Category model
use Illuminate\Support\Facades\Storage; // For file storage

class AbalosProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get(); // Load products with categories
        $categories = Category::all(); // Get all categories for selection
        return view('abaloschristianproduct', compact('products', 'categories'));
    }

    public function create()
{
    $categories = Category::all(); // Get all categories for selection
    return view('abaloschristianproduct', [
        'editProduct' => null,
        'categories' => $categories,
        'errors' => null, // Pass errors to the view
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,id'
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('abalos-products.index')->with('success', 'Product created successfully.');
}


    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('abalos-products.index')->with('error', 'Product not found.');
        }

        $categories = Category::all(); // Get all categories for selection
        return view('abaloschristianproduct', [
            'products' => Product::all(),
            'editProduct' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0', // Validate stock
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'category_id' => 'required|exists:categories,id' // Validate category selection
        ]);

        $product = Product::find($id);
        if ($product) {
            $imagePath = $product->image; // Keep the old image if not updated

            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('image')->store('images', 'public'); // Store new image
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock, // Update stock
                'image' => $imagePath, // Update image path
                'category_id' => $request->category_id,
            ]);
        }

        return redirect()->route('abalos-products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Delete the image file if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
        }

        return redirect()->route('abalos-products.index')->with('success', 'Product deleted successfully.');
    }
}
