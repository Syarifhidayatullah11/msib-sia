<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function admin()
    {
        return view('dashboard_admin');
    }
    
    
    public function manajer()
    {
        return view('dashboard_manajer');
    }

}
