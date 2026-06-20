<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($search = trim((string) $request->string('search'))) {
            $query->where(function ($builder) use ($search): void {
                $builder->where('description', 'like', '%' . $search . '%');
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('store.products.index', [
            'products' => $products,
            'search' => $search ?? '',
        ]);
    }

    public function show(Product $product): View
    {
        return view('store.products.show', compact('product'));
    }
}
