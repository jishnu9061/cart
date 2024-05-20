<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/05/19
 * Time: 00:30:16
 * Description: LoginController.php
 */

namespace App\Http\Controllers;

use App\Http\Helpers\ToastrHelper;

use App\Models\Product;
use App\Models\Category;

use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /**
     * Login Page
     *
     * @return [type]
     */
    public function login()
    {
        return view('pages.admin.auth.login');
    }

    /**
     * Login To Admin Panel
     *
     * @param LoginRequest $request
     *
     * @return [type]
     */
    public function doLogin(LoginRequest $request)
    {
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $totalCategories = Category::count();
            $totalProducts = Product::count();
            return view('pages.admin.dashboard', compact('totalCategories', 'totalProducts'));
        } else {
            ToastrHelper::error('Credentials is missing');
            return redirect()->route('login')->with('message', 'Invalid credentials');
        }
    }

    /**
     *Log Out
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function logOut(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
