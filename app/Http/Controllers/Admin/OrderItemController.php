<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class OrderItemController extends Controller
{
    public function index(): View
    {
        return view('admin.order-items.index');
    }

    public function data(): JsonResponse
    {
        $query = OrderItem::query()->with(['order', 'product'])->latest();

        return DataTables::eloquent($query)
            ->addColumn('order_number', fn (OrderItem $orderItem): string => $orderItem->order->order_number ?? '-')
            ->addColumn('product_name', fn (OrderItem $orderItem): string => $orderItem->product->name ?? '-')
            ->editColumn('unit_price', fn (OrderItem $orderItem): string => number_format((float) $orderItem->unit_price, 2))
            ->editColumn('subtotal', fn (OrderItem $orderItem): string => number_format((float) $orderItem->subtotal, 2))
            ->toJson();
    }
}
