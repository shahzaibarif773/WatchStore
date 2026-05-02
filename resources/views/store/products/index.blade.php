<x-layouts.store title="WatchStore | Products">
    @php
        $quickFilters = [
            ['label' => 'Men', 'search' => 'men'],
            ['label' => 'Women', 'search' => 'women'],
            ['label' => 'Luxury', 'search' => 'luxury'],
            ['label' => 'Sport', 'search' => 'sport'],
            ['label' => 'Steel', 'search' => 'steel'],
        ];
    @endphp

    <section class="grid gap-6 xl:grid-cols-[1.12fr_0.88fr]">
        <div class="store-panel p-8 sm:p-10">
            <span class="store-badge">Catalog</span>
            <h1 class="mt-5 text-5xl font-semibold text-slate-950 font-display sm:text-6xl">All watches</h1>
            <p class="mt-4 max-w-2xl text-base leading-8 text-slate-600">
                Browse refined timepieces for formal wear, daily style, and sporty occasions. Use search or quick filters to narrow the collection.
            </p>

            <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($quickFilters as $filter)
                    <a href="{{ route('products.index', ['search' => $filter['search']]) }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-amber-300 hover:bg-amber-50 hover:text-slate-950">
                        {{ $filter['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-1">
            <div class="store-panel p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Catalog size</p>
                <p class="mt-3 text-4xl font-semibold text-slate-950 font-display">{{ $products->total() }}</p>
                <p class="mt-2 text-sm leading-7 text-slate-600">Watches available across the demo store.</p>
            </div>
            <div class="store-panel p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Search</p>
                <p class="mt-3 text-base font-semibold text-slate-950">{{ $search ? 'Result: ' . $search : 'Showing the full collection' }}</p>
                <p class="mt-2 text-sm leading-7 text-slate-600">The search bar in the header filters the product grid instantly on page load.</p>
            </div>
        </div>
    </section>

    <section class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            @php($productImage = \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset($product->image))
            <article class="group store-panel overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-[0_28px_70px_rgba(15,23,42,0.18)]">
                <a href="{{ route('products.show', $product) }}" class="block">
                    <div class="relative overflow-hidden">
                        <img src="{{ $productImage }}" alt="{{ $product->name }}" class="h-72 w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent"></div>
                        @if($product->is_featured)
                            <span class="absolute left-4 top-4 rounded-full bg-amber-400 px-3 py-1 text-xs font-bold uppercase tracking-[0.25em] text-slate-950">Featured</span>
                        @endif
                    </div>
                    <div class="p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Watch</p>
                        <h2 class="mt-2 text-3xl font-semibold text-slate-950 font-display">{{ $product->name }}</h2>
                        <p class="mt-2 line-clamp-2 text-sm leading-7 text-slate-600">{{ $product->description }}</p>

                        <div class="mt-5 flex items-end justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Price</p>
                                <p class="mt-1 text-lg font-bold text-slate-950">PKR {{ number_format($product->price, 2) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Stock</p>
                                <p class="mt-1 text-lg font-bold text-slate-950">{{ $product->stock }}</p>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="flex items-center justify-between gap-3 border-t border-slate-200/70 px-5 py-4">
                    <a href="{{ route('products.show', $product) }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-amber-300 hover:bg-amber-50 hover:text-slate-950">View details</a>
                    <form method="POST" action="{{ route('cart.store', $product) }}">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-amber-400 hover:text-slate-950">Quick add</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="store-panel p-6 text-slate-600">No products available yet.</div>
        @endforelse
    </section>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</x-layouts.store>
