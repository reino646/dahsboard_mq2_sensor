<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataManageController extends Controller
{
    function index() {
        return view('dataManage');
    }
}
