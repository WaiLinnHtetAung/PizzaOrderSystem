<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SortingController extends Controller
{
    public function pizzaList(Request $request) {
        logger($request->status);

        if($request->status == 'asc') {
            $products = Product::orderBy('price', 'asc')->get();

            return $products;
        } else {
            $products = Product::orderBy('price', 'desc')->get();

            return $products;
        }
    }
}
