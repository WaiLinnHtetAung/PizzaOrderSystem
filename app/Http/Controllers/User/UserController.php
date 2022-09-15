<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
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
        $cart = Cart::where('user_id', auth()->user()->id)->get();

        return view('user.main.home', compact('products','categories', 'cart'));
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


    // ---------------update profile page------------
    public function updatePage($id, Request $request) {
        $this->profileValidationCheck($request);

        $data = $this->getProfileData($request);

        /*image store and change
        1. check and get old image name ==> delete it
        2. upload image
        */

        if($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null) {
                Storage::delete('public/'. $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        }

        User::where('id', $id)->update($data);

        return redirect()->back()->with(['updateSuccess' => 'Your profile is updated successfully']);
    }

    // -----------filter category---------
    public function filter($id) {
        $products = Product::where('category_id', $id)->orderBy('created_at')->get();
        $categories = Category::get();

        return view('user.main.home', compact('products', 'categories'));
    }

    // -------------product detail----------
    public function productDetail($id) {
        $product = Product::where('id', $id)->first();
        $productLists = Product::get();
        return view('user.main.detail', compact('product', 'productLists'));
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

    // ==================update profile validation check ===========
    private function profileValidationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp | file | image',

        ] )->validate();
    }

    // =====================get profile data=================
    private function getProfileData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ];
    }
}
