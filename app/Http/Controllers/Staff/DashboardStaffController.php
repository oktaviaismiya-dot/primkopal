<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardStaffController extends Controller
{
    public function DashboardStaff()
    {
        return view('dashboard');
    }
}
