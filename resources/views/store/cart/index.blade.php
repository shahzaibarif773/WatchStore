<x-layouts.store title="WatchStore | Cart">
    <section class="store-panel p-8 sm:p-10">
        <span class="store-badge">Shopping bag</span>
        <h1 class="mt-4 text-5xl font-semibold text-slate-950 font-display sm:text-6xl">Your cart</h1>
        <p class="mt-4 max-w-2xl text-base leading-8 text-slate-600">Review your selected watches before checkout. Adjust quantities, remove items, or continue browsing the collection.</p>
    </section>

    @if(empty($cartItems))
        <div class="mt-6 store-panel p-8 text-slate-600">
            Your cart is empty. Start browsing the collection to add a watch.
        </div>
    @else
        <div class="mt-6 grid gap-6 xl:grid-cols-[1.12fr_0.88fr]">
            <div class="space-y-4">
                @foreach($cartItems as $item)
                    @php($cartImage = \Illuminate\Support\Str::startsWith($item['image'], ['http://', 'https://']) ? $item['image'] : asset($item['image']))
                    <article class="store-panel p-5 sm:p-6">
                        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                            <div class="flex items-center gap-4">
                                <div class="h-24 w-24 overflow-hidden rounded-3xl bg-slate-100">
                                    <img src="{{ $cartImage }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <h2 class="text-3xl font-semibold text-slate-950 font-display">{{ $item['name'] }}</h2>
                                    <p class="mt-1 text-sm text-slate-500">PKR {{ number_format($item['price'], 2) }} each</p>
                                    <p class="mt-2 text-sm text-slate-500">Line total: PKR {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3">
                                <form method="POST" action="{{ route('cart.update', $item['product_id']) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-24 rounded-full border border-slate-300 bg-white px-4 py-2 text-center shadow-sm outline-none focus:border-amber-300 focus:ring-2 focus:ring-amber-200">
                                    <button type="submit" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-amber-400 hover:text-slate-950">Update</button>
                                </form>

                                <form method="POST" action="{{ route('cart.destroy', $item['product_id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-full border border-red-200 bg-white px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50">Remove</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <aside class="store-panel p-6 sm:p-8">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Order summary</p>
                <div class="mt-4 space-y-3 text-sm text-slate-600">
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                        <span>Items</span>
                        <span class="font-semibold text-slate-950">{{ count($cartItems) }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                        <span>Shipping</span>
                        <span class="font-semibold text-slate-950">Calculated at checkout</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                        <span>Secure payment</span>
                        <span class="font-semibold text-slate-950">Ready</span>
                    </div>
                </div>

                <div class="mt-6 rounded-[1.75rem] bg-slate-950 px-5 py-5 text-white shadow-[0_22px_50px_rgba(15,23,42,0.22)]">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Order total</p>
                    <p class="mt-2 text-5xl font-semibold text-amber-300 font-display">PKR {{ number_format($total, 2) }}</p>
                </div>

                <a href="{{ route('checkout.create') }}" class="store-button-primary mt-5 w-full">Proceed to checkout</a>
                <a href="{{ route('products.index') }}" class="store-button-secondary mt-3 w-full">Continue shopping</a>
            </aside>
        </div>
    @endif
</x-layouts.store>
