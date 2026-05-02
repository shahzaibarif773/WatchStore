<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('admin.orders.index');
    }

    public function data(): JsonResponse
    {
        $query = Order::query()->with('user')->latest();

        return DataTables::eloquent($query)
            ->addColumn('user_name', fn (Order $order): string => $order->user->name ?? 'N/A')
            ->editColumn('total_amount', fn (Order $order): string => number_format((float) $order->total_amount, 2))
            ->editColumn('placed_at', fn (Order $order): string => optional($order->placed_at)->format('Y-m-d H:i') ?? '-')
            ->addColumn('actions', function (Order $order): string {
                $showUrl = route('admin.orders.show', $order);

                return '<a href="' . $showUrl . '" class="rounded bg-slate-900 px-2 py-1 text-xs text-white">View</a>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,placed,processing,completed,cancelled'],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated.');
    }
}
