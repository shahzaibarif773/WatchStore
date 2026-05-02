<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = $this->getCart();
        $total = collect($cart)->sum(fn (array $item): float => $item['price'] * $item['quantity']);

        return view('store.cart.index', [
            'cartItems' => $cart,
            'total' => $total,
        ]);
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $this->getCart();
        $existingQty = $cart[$product->id]['quantity'] ?? 0;
        $newQty = $existingQty + $validated['quantity'];

        if ($newQty > $product->stock) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => (float) $product->price,
            'image' => $product->image,
            'quantity' => $newQty,
        ];

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $this->getCart();

        if (! isset($cart[$product->id])) {
            return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
        }

        if ($validated['quantity'] > $product->stock) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $cart[$product->id]['quantity'] = $validated['quantity'];
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $cart = $this->getCart();
        unset($cart[$product->id]);

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    private function getCart(): array
    {
        return session('cart', []);
    }
}
