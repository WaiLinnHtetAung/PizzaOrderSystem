<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
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
        // logger($request);

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

    // ------order detail ---------
    public function orderInfo($orderCode) {

        //for total price
        $order = Order::where('order_code', $orderCode)->first();

        $orderItems = OrderList::select('order_lists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
                                ->leftJoin('users', 'users.id', 'order_lists.user_id')
                                ->leftJoin('products', 'products.id', 'order_lists.product_id')
                                ->where('order_code', $orderCode)->get();


        return view('admin.order.orderItem', compact('orderItems', 'order'));
    }
}
