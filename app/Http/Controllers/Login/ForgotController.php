<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ForgotController extends Controller
{
    public function getFormForgot(){
        return view('guest.forgot');
    }

    public function sendResetPassword(Request $request){
        $request->validate(['email'=> 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status === Password::RESET_LINK_SENT){
            return back()->with(['status' => __($status)]);
        }else
            return back()->withErrors(['email' => __($status)]);
    }
}
