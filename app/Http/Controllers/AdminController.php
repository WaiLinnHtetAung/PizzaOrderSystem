<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // ============admin change password page ==============
    public function changePasswordPage() {
        return view('admin.account.changePassword');
    }

    // =============admin change password==============
    public function changePassword(Request $request) {

        /* 1. all fields must be filled
           2. pw must be at least 6 characters
           3. new pw and confirm pw must be same
           4. old pw must be same with db pw
           5. pw change
        */

        $this->passwordValidationCheck($request);

        $currentUser = User::select('password')->where('id', Auth::user()->id)->first();
        $currentUserPassword = $currentUser->password;

        if(Hash::check($request->currentPassword, $currentUserPassword)) {
           User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->newPassword)
           ]);

           return redirect()->route('category#list')->with(['passwordChanged' => 'Your password is changed successfully...']);
        }

        return back()->with(['notMatch' => "Current password doesn't match. Try again!"]);

    }


    // =================Admin Profile===================
    public function profile() {
        return view('admin.account.profile');
    }





    // ------------------private functions ----------------------

    // =============password validation check ==============
    private function passwordValidationCheck($request) {
        Validator::make($request->all(), [
            'currentPassword' => 'required | min:6',
            'newPassword' => 'required | min:6',
            'confirmPassword' => 'required | min:6 | same:newPassword'
        ])->validate();
    }
}
