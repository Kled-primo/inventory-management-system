<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderCompleteController extends Controller
{
    public function __invoke(Request $request)
    {
        $orders = collect();

        Order::where('order_status', OrderStatus::COMPLETE)
            ->latest()
            ->with('customer')
            ->chunk(100, function ($chunkedOrders) use ($orders) {

                $orders->push($chunkedOrders);

            });

        return view('orders.complete-orders', [
            'orders' => $orders
        ]);
    }
}
