<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // -------user home--------
    public function home() {

        $products = Product::orderBy('id', 'desc')->get();
        $categories = Category::get();

        return view('user.main.home', compact('products','categories'));
    }

    // ---------user password change----------
    public function changePage() {
        return view('user.account.changePassword');
    }

    // -----------change password-----------
    public function changePassword(Request $request) {
        $this->pwValidationCheck($request);

        $user = User::where('id', Auth::user()->id)->first();
        $dbHasPw = $user->password;

        if(Hash::check($request->currentPassword, $dbHasPw)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id', Auth::user()->id)->update($data);

            return redirect()->back()->with(['changeSuccess' => 'Your password is changed successfully']);
        }

        return redirect()->back()->with(['notMatch' => 'Your old password is not match. Please try again']);
    }


    // --------------profile edit page----------
    public function editPage() {
        return view('user.account.edit');
    }




    // -----------private function-------

    // ---------change password validation--------
    private function pwValidationCheck($request) {
            Validator::make($request->all(), [
            'currentPassword' => 'required | min:6',
            'newPassword' => 'required | min:6',
            'confirmPassword' => 'required | min:6 | same:newPassword',
        ])->validate();
    }
}
