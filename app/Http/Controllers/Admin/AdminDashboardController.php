<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    //Show dashboard admin
    public function adminDashboard(){
        return view('admin.dashboard');
    }
}
