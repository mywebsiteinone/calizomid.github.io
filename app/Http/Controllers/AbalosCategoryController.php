<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Ensure you have a Category model

class AbalosCategoryController extends Controller
{
    public function index(Request $request)
    {
        // Get the search input
        $search = $request->input('search');

        // Retrieve categories with optional search functionality and pagination
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10); // Adjust the number per page as needed

        // Return the view with categories and search term
        return view('abaloschristiancategory', compact('categories', 'search'));
    }

    public function create()
    {
        return view('abaloschristiancategory', ['editCategory' => null]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Category::create(['name' => $request->name]);
        return redirect()->route('abalos-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Request $request, $id)
{
    $category = Category::find($id);
    if (!$category) {
        return redirect()->route('abalos-categories.index')->with('error', 'Category not found.');
    }

    $search = $request->input('search');
    $categories = Category::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%");
    })->paginate(10); // Get paginated categories with optional search

    return view('abaloschristiancategory', [
        'editCategory' => $category,
        'categories' => $categories, // Pass paginated categories
        'search' => $search, // Pass the search term
    ]);
}

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category = Category::find($id);
        if ($category) {
            $category->update(['name' => $request->name]);
        }
        return redirect()->route('abalos-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
        return redirect()->route('abalos-categories.index')->with('success', 'Category deleted successfully.');
    }
}
