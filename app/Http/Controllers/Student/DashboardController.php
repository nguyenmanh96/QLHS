<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        if (Auth::user()->type !== 'Student') {
            return redirect()->back();
        }
        return view('student.dashboard');
    }
}
