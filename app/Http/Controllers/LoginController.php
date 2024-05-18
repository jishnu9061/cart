<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.admin.auth.login');
    }

    public function doLogin()
    {
        if (auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])) {
            return view('pages.admin.dashboard');
        } else {
            return redirect()->route('login')->with('message', 'invalid credential');
        }
    }
}
