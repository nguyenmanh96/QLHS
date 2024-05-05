<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getFormLogin()
    {
        return view('guest.login');
    }

    public function submitLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt([
            'email' => $email,
            'password' => $password,
        ])) {
            $user = Auth::user();
            Session::put('userinfo',$email);

            if ($user->type == 'Admin') {
                return redirect()->route('admin-dashboard')->with('success', 'Chào mừng ' . ' ' . $user->email);
            } elseif ($user->type == 'Student') {
                return redirect()->route('student-dashboard')->with('success', 'Chào mừng sinh viên' . ' ' . $user->email);
            }
        }
        return redirect()->back()->with([
            'error' => __('messages.login_fail'),
            'form_data' => $request->only('email')
        ]);
    }
}
