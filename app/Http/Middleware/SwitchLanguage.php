<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SwitchLanguage
{
    public function handle($request, Closure $next): Response
    {

        Session::has('locale') ? App::setLocale(Session::get('locale')) : '';
        return $next($request);

    }
}
