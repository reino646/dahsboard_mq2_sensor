<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        session(['displayName' => $request->displayName, 
        'photoURL' => $request->photoURL,
        ]);
        return response()->json(['status' => 'ok']);
    }
}
