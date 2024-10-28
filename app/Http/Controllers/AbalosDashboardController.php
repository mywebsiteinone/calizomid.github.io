<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category; // Assuming you have a Category model
 use App\Models\Product;  // Assuming you have a Product model
use Illuminate\Http\Request;

class AbalosDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('totalUsers', 'totalCategories','totalProducts'));
    }
}

