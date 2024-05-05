<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function adminDashboard(){
        return view('admin.dashboard');
    }
}
