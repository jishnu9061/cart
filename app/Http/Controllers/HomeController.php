<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/05/19
 * Time: 21:58:08
 * Description: HomeController.php
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Admin Dashboard
     *
     * @return [type]
     */
    public function home()
    {
        return view('pages.admin.dashboard');
    }
}
