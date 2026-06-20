<x-layouts.store title="WatchStore | Home">
    @php
        $topSellers = $featuredProducts->take(4);
    @endphp

    <section class="relative h-[30rem] overflow-hidden bg-[#2a2a2a] text-white sm:h-[34rem]">
        <img
            src="https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?auto=format&fit=crop&w=2200&q=80"
            alt="Luxury watch hero"
            class="h-full w-full object-cover"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/35 to-black/20"></div>

        <div class="absolute inset-y-0 left-0 right-0 mx-auto flex w-full max-w-[1240px] items-center px-8 lg:px-16">
            <button class="hidden h-10 w-10 items-center justify-center rounded-full border border-white/35 text-lg text-white/80 transition hover:text-white lg:inline-flex" aria-label="Previous">‹</button>
            <div class="mx-auto max-w-xl text-center lg:mx-0 lg:ml-16 lg:text-left">
                <p class="text-[0.64rem] uppercase tracking-[0.35em] text-slate-200">Latest Collection</p>
                <h1 class="mt-4 font-display text-5xl font-semibold uppercase tracking-[0.12em] text-white sm:text-6xl">MilanCelos</h1>
                <p class="mt-5 text-sm leading-7 text-slate-200">Quisque mi odio varius porttitor iaculis congue euismod. Donec risus elit faucibus vel sollicitudin at.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex border border-white/40 bg-transparent px-5 py-2.5 text-[0.64rem] font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-white hover:text-slate-900">Shop this collection</a>
            </div>
            <button class="hidden h-10 w-10 items-center justify-center rounded-full border border-white/35 text-lg text-white/80 transition hover:text-white lg:inline-flex" aria-label="Next">›</button>
        </div>

        <div class="absolute bottom-6 left-1/2 flex -translate-x-1/2 items-center gap-2">
            <span class="h-1.5 w-1.5 rounded-full bg-white/70"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-white/40"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-white/40"></span>
        </div>
    </section>

    <section class="grid border-y border-slate-200 bg-white text-[0.58rem] font-semibold uppercase tracking-[0.24em] text-slate-600 sm:grid-cols-2 lg:grid-cols-4">
        <div class="border-b border-slate-200 px-5 py-4 text-center sm:border-b-0 sm:border-r lg:px-6">Free shipping worldwide</div>
        <div class="border-b border-slate-200 px-5 py-4 text-center sm:border-b-0 lg:border-r lg:px-6">Free 15-day returns</div>
        <div class="border-b border-slate-200 px-5 py-4 text-center sm:border-b-0 sm:border-r lg:px-6">Genuine product guarantee</div>
        <div class="px-5 py-4 text-center lg:px-6">100% secure shopping</div>
    </section>

    <section class="bg-white px-4 pb-12 pt-10 sm:px-6 lg:px-10">
        <div class="text-center">
            <p class="text-[0.62rem] font-semibold uppercase tracking-[0.3em] text-slate-500">Top Sellers</p>
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @forelse($topSellers as $product)
                @php
                    $productImage = \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://'])
                        ? $product->image
                        : asset($product->image);

                    $fallbackBySlug = [
                        'classic-silver' => asset('images/watches/classic-silver.svg'),
                        'midnight-pro' => asset('images/watches/midnight-pro.svg'),
                        'royal-gold' => 'https://images.unsplash.com/photo-1542496658-e33a6d0d50f6',
                        'ocean-blue' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49',
                        'sport-edge' => asset('images/watches/sport-edge.svg'),
                        'urban-steel' => asset('images/watches/urban-steel.svg'),
                    ];

                    $fallbackImage = $fallbackBySlug[$product->slug] ?? asset('images/watches/classic-silver.svg');
                @endphp
                <article class="border border-slate-200 bg-white p-4 text-center">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <div class="relative h-56 overflow-hidden bg-slate-50">
                            <img src="{{ $productImage }}" alt="{{ $product->name }}" class="h-full w-full object-cover" onerror="this.onerror=null;this.src='{{ $fallbackImage }}';">
                            @if($product->is_featured)
                                <span class="absolute right-2 top-2 bg-black px-2 py-1 text-[0.52rem] font-semibold uppercase tracking-[0.2em] text-white">Hot</span>
                            @endif
                        </div>
                        <h2 class="mt-4 text-sm font-semibold text-slate-800">{{ $product->name }}</h2>
                        <p class="mt-2 text-xs text-slate-500">PKR {{ number_format($product->price, 2) }}</p>
                    </a>
                    <form method="POST" action="{{ route('cart.store', $product) }}" class="mt-4">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-black px-4 py-2 text-[0.58rem] font-semibold uppercase tracking-[0.24em] text-white transition hover:bg-slate-800">Add to cart</button>
                    </form>
                </article>
            @empty
                <div class="col-span-full border border-slate-200 bg-white p-8 text-center text-sm text-slate-600">No featured products yet.</div>
            @endforelse
        </div>
    </section>

    <section class="grid gap-4 bg-[#efefef] px-4 pb-10 sm:grid-cols-2 sm:px-6 lg:px-10">
        <a href="{{ route('products.index', ['search' => 'women']) }}" class="group relative h-44 overflow-hidden bg-slate-900 sm:h-56">
            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1400&q=80" alt="Women's watches" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/35"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-sm font-semibold uppercase tracking-[0.34em] text-white">Women's Watches</span>
            </div>
        </a>
        <a href="{{ route('products.index', ['search' => 'men']) }}" class="group relative h-44 overflow-hidden bg-slate-900 sm:h-56">
            <img src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=1400&q=80" alt="Men's watches" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/35"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-sm font-semibold uppercase tracking-[0.34em] text-white">Men's Watches</span>
            </div>
        </a>
    </section>
</x-layouts.store>
