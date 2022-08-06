<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
