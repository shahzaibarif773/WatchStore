<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::query()
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        return view('store.home', compact('featuredProducts'));
    }
}
