<x-layouts.store title="WatchStore | Product Details">
    @php
        $productImage = \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset($product->image);
    @endphp

    <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
        <section class="store-panel overflow-hidden">
            <div class="relative">
                <img src="{{ $productImage }}" alt="{{ $product->name }}" class="h-full min-h-[30rem] w-full object-cover">
                @if($product->is_featured)
                    <span class="absolute left-4 top-4 rounded-full bg-amber-400 px-3 py-1 text-xs font-bold uppercase tracking-[0.25em] text-slate-950">Featured</span>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
            </div>
            <div class="grid gap-3 border-t border-slate-200/70 p-5 sm:grid-cols-3">
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Craft</p>
                    <p class="mt-2 text-base font-semibold text-slate-950">Refined finish</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Shipping</p>
                    <p class="mt-2 text-base font-semibold text-slate-950">Fast dispatch</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Support</p>
                    <p class="mt-2 text-base font-semibold text-slate-950">Concierge help</p>
                </div>
            </div>
        </section>

        <aside class="store-panel p-8 sm:p-10">
            <span class="store-badge">Product detail</span>
            <h1 class="mt-4 text-5xl font-semibold text-slate-950 font-display sm:text-6xl">{{ $product->name }}</h1>
            <p class="mt-5 text-base leading-8 text-slate-600">{{ $product->description }}</p>

            <div class="mt-6 flex items-end justify-between gap-4 rounded-[1.75rem] bg-slate-950 px-5 py-4 text-white shadow-[0_22px_50px_rgba(15,23,42,0.22)]">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Price</p>
                    <p class="mt-1 text-3xl font-bold text-amber-300">PKR {{ number_format($product->price, 2) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Stock</p>
                    <p class="mt-1 text-2xl font-bold">{{ $product->stock }}</p>
                </div>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-3">
                <div class="rounded-3xl border border-slate-200 bg-white p-4 text-sm text-slate-600">Secure checkout</div>
                <div class="rounded-3xl border border-slate-200 bg-white p-4 text-sm text-slate-600">Simple returns</div>
                <div class="rounded-3xl border border-slate-200 bg-white p-4 text-sm text-slate-600">Premium packaging</div>
            </div>

            <form method="POST" action="{{ route('cart.store', $product) }}" class="mt-8 space-y-4">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Quantity</label>
                    <input type="number" name="quantity" min="1" max="{{ max($product->stock, 1) }}" value="1" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-lg shadow-sm outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-200 sm:w-32" @disabled($product->stock < 1)>
                </div>
                <button type="submit" class="store-button-primary w-full sm:w-auto" @disabled($product->stock < 1)>
                    Add to cart
                </button>
            </form>
        </aside>
    </div>
</x-layouts.store>
