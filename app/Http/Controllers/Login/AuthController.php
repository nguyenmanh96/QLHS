<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getFormLogin()
    {
        if (Auth::check()){
            return redirect()->back();
        }
        return view('guest.login');
    }

    public function submitLogin(Request $request)
    {
//        dd(Auth::user());
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ],
            [
                'email.required' => __('validation.email_required'),
                'email.email' => __('validation.email_email'),
                'email.max' => __('validation.email_max', ['max' => 255]),
                'password.required' => __('validation.password_required'),
            ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt([
            'email' => $email,
            'password' => $password,
        ])) {
            $user = Auth::user();

            if ($user->type == 'Admin') {
                return redirect('admin/dashboard')->with('success', __('messages.welcome') . ' ' . $user->email);
            } elseif ($user->type == 'Student') {
                return redirect('student/dashboard')->with('success', __('messages.welcome_st') . ' ' . $user->email);
            }
        }

        return redirect()->back()->with([
            'error' => __('messages.login_fail'),
        ])->withInput($request->only('email','password'));
    }
}
