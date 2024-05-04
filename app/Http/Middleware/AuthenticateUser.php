<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateUser
{

    public function handle(Request $request, Closure $next)
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
