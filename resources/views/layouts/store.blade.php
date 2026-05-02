<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'WatchStore' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen">
    <header class="bg-slate-900 text-white">
        <div class="mx-auto max-w-6xl px-4 py-4 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold tracking-wider">WatchStore</a>
            <nav class="flex flex-wrap items-center gap-3 text-sm">
                <a href="{{ route('home') }}" class="hover:text-amber-300">Home</a>
                <a href="{{ route('products.index') }}" class="hover:text-amber-300">Products</a>
                <a href="{{ route('cart.index') }}" class="hover:text-amber-300">Cart ({{ count(session('cart', [])) }})</a>

                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-300">Admin</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="hover:text-amber-300">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-amber-300">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-amber-300">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-amber-300">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @if (session('success'))
            <div class="mb-4 rounded border border-emerald-300 bg-emerald-50 px-4 py-3 text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded border border-red-300 bg-red-50 px-4 py-3 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded border border-red-300 bg-red-50 px-4 py-3 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>
