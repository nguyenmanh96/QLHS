<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getFormLogin()
    {
        return view('login.login');
    }

    public function submitLogin(Request $request)
    {
       $email = $request->input('email');
       $password =$request->input('password');


       if (Auth::attempt([
            'email'=> $email,
            'password'=> $password,
       ])) {
            $user = User::where('type','==','Admin')->get()->first();
       }

    }
}
