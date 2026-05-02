<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::query()->where('email', 'customer@watchstore.test')->first();
        $products = Product::query()->take(3)->get();

        if (! $customer || $products->count() < 3) {
            return;
        }

        $order = Order::query()->updateOrCreate(
            ['order_number' => 'ORD-DEMO-1001'],
            [
                'user_id' => $customer->id,
                'total_amount' => 0,
                'status' => 'placed',
                'customer_name' => 'Class Project Customer',
                'customer_email' => 'customer@watchstore.test',
                'customer_phone' => '+92-300-0000001',
                'shipping_address' => 'Street 1, Lahore, Pakistan',
                'notes' => 'Demo order seeded for admin testing.',
                'placed_at' => now()->subDays(2),
            ]
        );

        OrderItem::query()->where('order_id', $order->id)->delete();

        $total = 0;
        foreach ($products as $index => $product) {
            $quantity = $index + 1;
            $unitPrice = (float) $product->price;
            $subtotal = $quantity * $unitPrice;

            OrderItem::query()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->update(['total_amount' => $total]);
    }
}
