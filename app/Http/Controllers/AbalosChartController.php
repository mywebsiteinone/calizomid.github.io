<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Assuming you have a Product model

class AbalosChartController extends Controller
{
    public function index()
    {
        // Fetch categories and product counts
        $products = Product::with('category') // Load the category relationship
            ->select('category_id', \DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->get();

        // Prepare data for the chart
        $categories = [];
        $productCounts = [];
        
        foreach ($products as $product) {
            $categoryName = $product->category->name; // Access category name
            $categories[] = $categoryName;
            $productCounts[] = $product->count;
        }

        return view('abaloschristianreport', [
            'categories' => $categories,
            'productCounts' => $productCounts,
            'products' => $products // Send products data for detailed view
        ]);
    }
}
