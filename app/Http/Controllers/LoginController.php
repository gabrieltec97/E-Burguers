<?php

namespace App\Http\Controllers;

use App\deliver;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function login()
    {
        $districts = deliver::all();

        return view('clientUser.clientLogin', compact('districts'));
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
