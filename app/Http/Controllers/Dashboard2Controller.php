<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard2Controller extends Controller
{
    function index2() {
                //return view('dashboard');
            if (empty(session('displayName')))
                return redirect('/');
        return view('dashboard2');
    }
}
