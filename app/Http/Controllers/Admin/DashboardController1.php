<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController1 extends Controller
{
    public function dashboard1()
{
    return view('admin.dashboard1');
}
}
