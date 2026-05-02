<x-layouts.store title="Admin | Order Details">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Order {{ $order->order_number }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="rounded bg-slate-200 px-4 py-2 font-semibold">Back</a>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <section class="rounded-xl bg-white p-5 shadow">
            <h2 class="text-xl font-semibold">Customer Information</h2>
            <div class="mt-4 space-y-2 text-sm">
                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                <p><strong>Notes:</strong> {{ $order->notes ?: '-' }}</p>
            </div>
        </section>

        <section class="rounded-xl bg-white p-5 shadow">
            <h2 class="text-xl font-semibold">Order Status</h2>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="mt-4 flex gap-3">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded border border-slate-300">
                    @foreach(['pending', 'placed', 'processing', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded bg-slate-900 px-4 py-2 font-semibold text-white">Update</button>
            </form>

            <div class="mt-4 text-sm">
                <p><strong>Total:</strong> PKR {{ number_format($order->total_amount, 2) }}</p>
                <p><strong>Placed At:</strong> {{ optional($order->placed_at)->format('Y-m-d H:i') }}</p>
            </div>
        </section>
    </div>

    <section class="mt-8 rounded-xl bg-white p-5 shadow">
        <h2 class="text-xl font-semibold">Order Items</h2>
        <div class="mt-4 overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Product</th>
                        <th class="py-2">Quantity</th>
                        <th class="py-2">Unit Price</th>
                        <th class="py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b">
                            <td class="py-2">{{ $item->product->name ?? '-' }}</td>
                            <td class="py-2">{{ $item->quantity }}</td>
                            <td class="py-2">PKR {{ number_format($item->unit_price, 2) }}</td>
                            <td class="py-2">PKR {{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layouts.store>
