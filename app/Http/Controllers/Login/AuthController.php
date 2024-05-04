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
        return view('guest.login');
    }

    public function submitLogin()
    {

        return view('admin.dashboard');
    }
}
