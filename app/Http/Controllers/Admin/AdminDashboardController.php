<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //Show dashboard admin
    public function adminDashboard(){
        return view('admin.dashboard');
    }
}
