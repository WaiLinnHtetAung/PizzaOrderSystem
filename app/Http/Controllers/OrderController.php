<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ---------order list-------
    public function orderList() {

        $orders = Order::select('orders.*', 'users.name as user_name')
                        ->leftJoin('users', 'users.id', 'orders.user_id')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.order.list', compact('orders'));
    }

    public function orderStatus(Request $request) {
        logger($request);

        $orderStatus = Order::select('orders.*', 'users.name as user_name')
                              ->leftJoin('users', 'users.id', 'orders.user_id')
                              ->orderBy('created_at', 'desc');

        if($request->status == 'all') {
            $orderStatus = $orderStatus->get();
        } else {
            $orderStatus = $orderStatus->where('orders.status', $request->status)->get();
        }

        return response()->json($orderStatus, 200);
    }

    public function changeStatus(Request $request) {
        Order::where('id', $request->orderId)->update([
            'status' => $request->status,
        ]);

    }
}
