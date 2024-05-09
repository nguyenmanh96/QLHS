<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateLogout
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::logout()) ;

        return $next($request);
    }
}
