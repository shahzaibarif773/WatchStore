<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index');
    }

    public function data(): JsonResponse
    {
        $query = Product::query()->latest();

        return DataTables::eloquent($query)
            ->editColumn('price', fn (Product $product): string => number_format((float) $product->price, 2))
            ->editColumn('is_featured', fn (Product $product): string => $product->is_featured ? 'Yes' : 'No')
            ->addColumn('actions', function (Product $product): string {
                $editUrl = route('admin.products.edit', $product);
                $deleteUrl = route('admin.products.destroy', $product);

                return '<div class="flex gap-2">'
                    . '<a href="' . $editUrl . '" class="rounded bg-slate-900 px-2 py-1 text-xs text-white">Edit</a>'
                    . '<form method="POST" action="' . $deleteUrl . '">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="rounded bg-red-600 px-2 py-1 text-xs text-white" onclick="return confirm(\'Delete this product?\')">Delete</button>'
                    . '</form>'
                    . '</div>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        Product::query()->create([
            ...$validated,
            'slug' => $this->generateUniqueSlug($validated['name']),
            'is_featured' => (bool) ($validated['is_featured'] ?? false),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $slug = $product->name !== $validated['name']
            ? $this->generateUniqueSlug($validated['name'], $product->id)
            : $product->slug;

        $product->update([
            ...$validated,
            'slug' => $slug,
            'is_featured' => (bool) ($validated['is_featured'] ?? false),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->orderItems()->exists()) {
            return redirect()->route('admin.products.index')->with('error', 'Cannot delete product linked to order items.');
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (Product::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
