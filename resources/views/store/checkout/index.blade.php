<x-layouts.store title="WatchStore | Checkout">
    <section class="store-panel p-8 sm:p-10">
        <span class="store-badge">Secure checkout</span>
        <h1 class="mt-4 text-5xl font-semibold text-slate-950 font-display sm:text-6xl">Checkout</h1>
        <p class="mt-4 max-w-2xl text-base leading-8 text-slate-600">Enter your details to place the order. This project keeps the checkout direct and database-backed without a payment gateway.</p>
    </section>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <section class="store-panel p-6 sm:p-8">
            <h2 class="text-3xl font-semibold text-slate-950 font-display">Customer details</h2>

            <form method="POST" action="{{ route('checkout.store') }}" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Full name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $user->name) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email', $user->email) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Phone</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Shipping address</label>
                    <textarea name="shipping_address" rows="3" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">{{ old('shipping_address') }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Order notes</label>
                    <textarea name="notes" rows="3" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="store-button-primary w-full">Place order</button>
            </form>
        </section>

        <aside class="store-panel p-6 sm:p-8">
            <h2 class="text-3xl font-semibold text-slate-950 font-display">Order summary</h2>
            <div class="mt-5 space-y-3">
                @foreach($cartItems as $item)
                    <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        <span class="text-slate-700">{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                        <span class="font-semibold text-slate-950">PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-[1.75rem] bg-slate-950 px-5 py-5 text-white shadow-[0_22px_50px_rgba(15,23,42,0.22)]">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Total</p>
                <p class="mt-2 text-5xl font-semibold text-amber-300 font-display">PKR {{ number_format($total, 2) }}</p>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-4 text-sm text-slate-600">Secure and direct checkout</div>
                <div class="rounded-3xl border border-slate-200 bg-white p-4 text-sm text-slate-600">No payment gateway required</div>
            </div>
        </aside>
    </div>
</x-layouts.store>
