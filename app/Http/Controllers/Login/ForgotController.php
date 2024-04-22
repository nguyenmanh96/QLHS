<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotController extends Controller
{
    public function fogortAccount(){
        return view('acclogin.forgot');
    }
}
