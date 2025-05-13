<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    function index2() {
                //return view('dashboard');
            if (empty(session('displayName')))
                return redirect('/');
        return view('userDashboard');
    }
}
