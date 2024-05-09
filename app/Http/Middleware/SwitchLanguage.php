<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class SwitchLanguage
{
    public function handle($request, Closure $next)
    {

        if ($request->input('locale') != '') {
            $locale = $request->input('locale');
            Session::put('locale', $locale);
        }

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
