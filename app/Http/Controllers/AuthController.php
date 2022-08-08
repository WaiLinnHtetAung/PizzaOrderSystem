<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login Page
    public function loginPage() {
        return view('login');
    }

    // register page
    public function registerPage() {
        return view('register');
    }

    //dashboard to admin & user
    public function dashboard() {
        if(Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }
}
