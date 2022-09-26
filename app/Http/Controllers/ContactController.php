<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact() {
        return view('user.contact.contact');
    }

    public function message(Request $request) {
        Contact::create($request->all());

        return redirect()->route('user#home')->with(['message' => 'Your message is sent.']);
    }
}
