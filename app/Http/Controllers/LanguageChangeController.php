<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageChangeController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $locale = $request->input('locale');
        Session::put('locale', $locale);

        return redirect()->back();
    }
}
