<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(fn (array $item): float => $item['price'] * $item['quantity']);

        return view('store.checkout.index', [
            'cartItems' => $cart,
            'total' => $total,
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($request, $validated, $cart): void {
            $orderTotal = 0;
            $lineItems = [];

            foreach ($cart as $productId => $item) {
                $product = Product::query()->lockForUpdate()->findOrFail($productId);
                $quantity = (int) $item['quantity'];

                if ($quantity > $product->stock) {
                    abort(422, "Insufficient stock for {$product->name}.");
                }

                $unitPrice = (float) $product->price;
                $subtotal = $unitPrice * $quantity;

                $lineItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ];

                $orderTotal += $subtotal;
                $product->decrement('stock', $quantity);
            }

            $order = Order::query()->create([
                'user_id' => $request->user()->id,
                'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'total_amount' => $orderTotal,
                'status' => 'placed',
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'notes' => $validated['notes'] ?? null,
                'placed_at' => now(),
            ]);

            foreach ($lineItems as $lineItem) {
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $lineItem['product_id'],
                    'quantity' => $lineItem['quantity'],
                    'unit_price' => $lineItem['unit_price'],
                    'subtotal' => $lineItem['subtotal'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully.');
    }
}
