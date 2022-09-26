<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function userList() {

        $users = User::where('role', 'user')->paginate(3);
        return view('admin.user.list', compact('users'));
    }

    public function changeRole(Request $request) {

        User::where('id', $request->userId)->update(['role' => $request->role]);
    }

    // -----increase view count----
    public function viewCount(Request $request) {
        $product = Product::where('id', $request->productId)->first();

        Product::where('id', $request->productId)->update(['view_count' => $product->view_count +1]);
    }
}
