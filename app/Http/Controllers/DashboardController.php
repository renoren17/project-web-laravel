<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function user()
    {
        return view('dashboard.user');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }
}
