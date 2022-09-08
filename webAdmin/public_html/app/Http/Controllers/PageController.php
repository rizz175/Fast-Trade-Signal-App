<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{  

    public function dashboardIndex(){
        return view('dashboard');
    }
    
    public function showAdminLogin(){
        return view('auth.login');
    }


}
