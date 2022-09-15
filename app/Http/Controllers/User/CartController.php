<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addCart(Request $request) {

        $data = $this->getAddData($request);

        Cart::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Item is added to cart successfully',
        ];

        return response()->json($response,200);
    }

    public function cart() {
        $cartItems = Cart::select('carts.*', 'products.name as product_name', 'products.price as product_price','products.image')
                            ->leftJoin('products', 'products.id', 'carts.product_id')
                            ->where('user_id', auth()->user()->id)
                            ->get();
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product_price * $item->qty;
        }

        return view('user.main.cart', compact('cartItems', 'totalPrice'));
    }







    // -----------private functions--------
    // ------get add cart data------
    private function getAddData($request) {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
        ];
    }
}
