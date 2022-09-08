<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function adminLogin(Request $request){
        // dd($request);
        $remember = $request->remember == 'on'? true:false;

        $cred = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::guard('admin')->attempt($cred,$remember)){
            // dd("here");
            toastr()->success("Well'come to Signal Trading System");
            return redirect()->intended('/');
        }
         else {
            // dd("here");
            toastr()->error("username and password is not match");
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login.page');
    }
}
