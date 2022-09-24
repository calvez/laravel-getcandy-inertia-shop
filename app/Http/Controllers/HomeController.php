<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use GetCandy\Models\Product;

class HomeController extends Controller
{
    public function getHome()
    {
        $products = Product::with('media', 'urls')->latest()->paginate(20);

        return Inertia::render('Home', ['products' => $products]);
    }
}
