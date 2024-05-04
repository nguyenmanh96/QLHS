<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateLogin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (Auth::check()) {
            if (Auth::user()->type === 'Admin') {
                return redirect()->route('admin-dashboard')->with('success', 'Chào mừng' . ' ' . $user->email);
            } elseif (Auth::check() && Auth::user()->type === 'Student') {

                return redirect()->route('student-dashboard')->with('success', 'Chào mừng' . ' ' . $user->email);
            }
        }
        return $next($request);
    }
}
