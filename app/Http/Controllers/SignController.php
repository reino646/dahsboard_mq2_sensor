<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignController extends Controller
{
    //
    function signin($displayName){
        session(['displayName' => $displayName]);
        return redirect('dashboard2');
    }

    function signout(){
        session() -> flush();

        return redirect('/');
    }
}
