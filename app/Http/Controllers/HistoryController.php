<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    function index() {
        if (empty(session('displayName')))
        return redirect('/');
        return view('history');
    }
}
