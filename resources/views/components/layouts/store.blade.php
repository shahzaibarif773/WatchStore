<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'WatchStore' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-[#efefef] font-['Manrope',sans-serif] text-slate-900 antialiased">
    @php
        $isAdminArea = request()->routeIs('admin.*');
        $cartCount = count(session('cart', []));
        $year = now()->year;
    @endphp

    @if($isAdminArea)
        <header class="sticky top-0 z-40 border-b border-white/70 bg-white/80 shadow-[0_12px_30px_rgba(15,23,42,0.08)] backdrop-blur-xl">
            <div class="border-b border-slate-200/70 bg-slate-950 text-white">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-3 px-4 py-2 text-[0.65rem] uppercase tracking-[0.35em] text-slate-300 lg:px-6">
                    <span>Admin workspace</span>
                    <span class="hidden sm:inline">Control products, orders, and users</span>
                    <span class="text-amber-200">Storefront tools</span>
                </div>
            </div>
            <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 lg:flex-row lg:items-center lg:justify-between lg:px-6">
                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-950 via-slate-800 to-amber-500 text-lg font-bold text-amber-200 shadow-lg shadow-slate-950/20">W</span>
                    <span>
                        <span class="block text-2xl font-semibold tracking-[0.22em] uppercase text-slate-950">WatchStore</span>
                        <span class="block text-xs uppercase tracking-[0.35em] text-slate-500">Admin panel</span>
                    </span>
                </a>
                <nav class="flex flex-wrap items-center gap-2 text-sm font-semibold text-slate-700">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-full bg-slate-950 px-4 py-2 text-white transition hover:bg-slate-800">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 transition hover:border-amber-300 hover:bg-amber-50">Products</a>
                    <a href="{{ route('admin.orders.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 transition hover:border-amber-300 hover:bg-amber-50">Orders</a>
                    <a href="{{ route('admin.users.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 transition hover:border-amber-300 hover:bg-amber-50">Users</a>
                    <a href="{{ route('home') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 transition hover:border-slate-300 hover:bg-slate-50">Back to store</a>
                </nav>
            </div>
        </header>
    @else
        <header>
            <div class="border-b border-slate-200 bg-white text-[0.62rem] font-semibold uppercase tracking-[0.22em] text-slate-500">
                <div class="mx-auto flex max-w-[1240px] items-center justify-between gap-3 px-4 py-2 lg:px-6">
                    <span>Use this area to announce and handle various limited time offers from trend products</span>
                    <button type="button" class="text-slate-400 transition hover:text-slate-700" aria-label="Close notice">x</button>
                </div>
            </div>
            <div class="bg-[#1e1e1e] text-white">
                <div class="mx-auto flex max-w-[1240px] items-center justify-between gap-4 px-4 py-2.5 text-[0.66rem] uppercase tracking-[0.2em] text-slate-200 lg:px-6">
                    <div class="flex items-center gap-4">
                        <span>+92 349 460</span>
                        <span class="hidden sm:inline">support@watchstore.com</span>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('profile.edit') }}" class="transition hover:text-white">Account</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="transition hover:text-white">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="transition hover:text-white">{{ __('Sign in') }}</a>
                            <span class="text-slate-600" aria-hidden="true">|</span>
                            <a href="{{ route('register') }}" class="transition hover:text-white">{{ __('Sign up') }}</a>
                        @endauth
                        <a href="{{ route('cart.index') }}" class="transition hover:text-white">Cart ({{ $cartCount }})</a>
                    </div>
                </div>
            </div>
            <div class="bg-[#111111] text-white">
                <div class="mx-auto flex max-w-[1240px] items-center justify-center px-4 py-4 lg:px-6">
                    <a href="{{ route('home') }}" class="text-2xl font-semibold uppercase tracking-[0.34em] text-white">Luxwii</a>
                </div>
            </div>
            <div class="border-t border-white/10 bg-[#1a1a1a]">
                <div class="mx-auto max-w-[1240px] overflow-x-auto px-4 py-3 lg:px-6">
                    <nav class="flex min-w-max items-center justify-center gap-7 text-[0.64rem] font-semibold uppercase tracking-[0.24em] text-slate-200">
                        <a href="{{ route('products.index', ['search' => 'new']) }}" class="transition hover:text-white">New styles</a>
                        <a href="{{ route('products.index', ['search' => 'men']) }}" class="transition hover:text-white">Men's</a>
                        <a href="{{ route('products.index', ['search' => 'women']) }}" class="transition hover:text-white">Women's</a>
                        <a href="{{ route('products.index', ['search' => 'jewelry']) }}" class="transition hover:text-white">Jewelry</a>
                        <a href="{{ route('products.index') }}" class="transition hover:text-white">Accessories</a>
                        <a href="{{ route('products.index', ['search' => 'blog']) }}" class="transition hover:text-white">Blog</a>
                        <a href="{{ route('contact.create') }}" class="transition hover:text-white">FAQs</a>
                    </nav>
                </div>
            </div>
            <div class="border-b border-slate-200 bg-white">
                <div class="mx-auto flex max-w-[1240px] items-center justify-between px-4 py-2.5 lg:px-6">
                    <form method="GET" action="{{ route('products.index') }}" class="relative w-full max-w-xs">
                        <input type="search" name="search" placeholder="Search products..." class="w-full border border-slate-200 bg-white px-3 py-1.5 pr-8 text-xs uppercase tracking-[0.16em] text-slate-700 outline-none focus:border-slate-400">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-500 transition hover:text-slate-800" aria-label="Search">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M10 4a6 6 0 104.472 10.028l4.75 4.75 1.414-1.414-4.75-4.75A6 6 0 0010 4zm0 2a4 4 0 110 8 4 4 0 010-8z"/></svg>
                        </button>
                    </form>
                    <a href="{{ route('products.index') }}" class="text-[0.62rem] font-semibold uppercase tracking-[0.24em] text-slate-600 transition hover:text-slate-900">Shop all</a>
                </div>
            </div>
        </header>
    @endif

    <main class="mx-auto {{ $isAdminArea ? 'max-w-7xl px-4 py-8 lg:px-6' : 'max-w-[1240px]' }}">
        @if (session('success'))
            <div class="mb-5 mt-4 rounded border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 mt-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 mt-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="{{ $isAdminArea ? 'mt-16 border-t border-white/70 bg-white/70 backdrop-blur-xl' : 'mt-12 border-t border-slate-300 bg-white' }}">
        <div class="mx-auto max-w-7xl px-4 py-10 lg:px-6">
            @if ($isAdminArea)
                <div class="flex flex-col gap-3 text-sm text-slate-600 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">WatchStore Admin</p>
                        <p class="mt-2 text-base text-slate-800">Manage products, orders, and users from a cleaner control room.</p>
                    </div>
                    <p class="text-slate-500">{{ $year }} WatchStore</p>
                </div>
            @else
                <div class="grid gap-8 md:grid-cols-[1.2fr_0.8fr_0.8fr]">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">WatchStore</p>
                        <h2 class="mt-3 font-display text-3xl font-semibold text-slate-950">Classic watch ecommerce presentation.</h2>
                        <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600">Built with a timeless storefront style inspired by premium catalog themes.</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Shop</p>
                        <div class="mt-4 space-y-3 text-sm text-slate-600">
                            <a href="{{ route('products.index') }}" class="block transition hover:text-slate-950">Browse collection</a>
                            <a href="{{ route('cart.index') }}" class="block transition hover:text-slate-950">Shopping cart</a>
                            <a href="{{ route('checkout.create') }}" class="block transition hover:text-slate-950">Checkout</a>
                            @guest
                                <a href="{{ route('register') }}" class="block transition hover:text-slate-950">{{ __('Create account') }}</a>
                            @endguest
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Support</p>
                        <div class="mt-4 space-y-3 text-sm text-slate-600">
                            <a href="{{ route('contact.create') }}" class="block transition hover:text-slate-950">Contact concierge</a>
                            <span class="block">Secure checkout</span>
                            <span class="block">Fast shipping copy</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-2 border-t border-slate-200/70 pt-6 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <p>Designed with a luxury marketplace visual language.</p>
                    <p>{{ $year }} WatchStore</p>
                </div>
            @endif
        </div>
    </footer>

    @stack('scripts')
</body>
</html>