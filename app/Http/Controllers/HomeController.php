<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Show a few featured products on the home page.
        $products = Product::latest()->take(4)->get();
        return view('home', compact('products'));
    }
}
