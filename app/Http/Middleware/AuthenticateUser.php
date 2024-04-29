<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateUser
{

    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt([
            'email' => $email,
            'password' => $password,
        ])) {
            $user = Auth::user();

            if ($user->type == 'Admin') {
                return redirect()->route('adminlogin')->with('success', 'Chào mừng'. ' ' . $user->email);
            } elseif($user->type == 'Student') {
                return redirect()->route('studentlogin')->with('success', 'Chào mừng sinh viên'. ' ' . $user->email);;
            }
        }
        return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác.');
    }
}
