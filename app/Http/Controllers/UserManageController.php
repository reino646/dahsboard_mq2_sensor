<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManageController extends Controller
{
    function index() {
                //return view('dashboard');
            if (empty(session('displayName')))
                return redirect('/');
        return view('userManage');
    }
}
