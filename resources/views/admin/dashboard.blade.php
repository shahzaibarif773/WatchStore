<x-layouts.store title="Admin Dashboard">
    <div class="rounded-[2rem] border border-amber-200/60 bg-gradient-to-r from-slate-950 to-slate-800 px-6 py-8 text-white shadow-2xl">
        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-200">Admin Overview</p>
        <h1 class="mt-3 font-['Cormorant_Garamond',serif] text-5xl font-semibold text-white">WatchStore Control Room</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-300 sm:text-base">Monitor products, orders, users, and revenue from one central dashboard built for your Laravel class project.</p>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-[1.75rem] border border-white/70 bg-white/85 p-5 shadow-lg backdrop-blur">
            <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Products</p>
            <p class="mt-3 font-['Cormorant_Garamond',serif] text-5xl font-semibold text-slate-950">{{ $stats['products'] }}</p>
        </div>
        <div class="rounded-[1.75rem] border border-white/70 bg-white/85 p-5 shadow-lg backdrop-blur">
            <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Orders</p>
            <p class="mt-3 font-['Cormorant_Garamond',serif] text-5xl font-semibold text-slate-950">{{ $stats['orders'] }}</p>
        </div>
        <div class="rounded-[1.75rem] border border-white/70 bg-white/85 p-5 shadow-lg backdrop-blur">
            <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Users</p>
            <p class="mt-3 font-['Cormorant_Garamond',serif] text-5xl font-semibold text-slate-950">{{ $stats['users'] }}</p>
        </div>
        <div class="rounded-[1.75rem] border border-white/70 bg-white/85 p-5 shadow-lg backdrop-blur">
            <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Revenue</p>
            <p class="mt-3 font-['Cormorant_Garamond',serif] text-4xl font-semibold text-slate-950">PKR {{ number_format($stats['revenue'], 2) }}</p>
        </div>
    </div>

    <section class="mt-8 rounded-[2rem] border border-white/70 bg-white/85 p-6 shadow-xl backdrop-blur">
        <h2 class="font-['Cormorant_Garamond',serif] text-4xl font-semibold text-slate-950">Recent Orders</h2>
        <div class="mt-5 overflow-x-auto">
            <table class="w-full min-w-[720px] text-left text-sm">
                <thead class="text-slate-500">
                    <tr class="border-b border-slate-200 uppercase tracking-[0.25em]">
                        <th class="py-3">Order #</th>
                        <th class="py-3">User</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr class="border-b border-slate-100">
                            <td class="py-4 font-medium text-slate-900">{{ $order->order_number }}</td>
                            <td class="py-4 text-slate-600">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="py-4">
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-700">{{ $order->status }}</span>
                            </td>
                            <td class="py-4 font-semibold text-slate-900">PKR {{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-slate-600">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts.store>
