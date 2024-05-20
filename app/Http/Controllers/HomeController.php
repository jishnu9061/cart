<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/05/19
 * Time: 21:58:08
 * Description: HomeController.php
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

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
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        return view('pages.admin.dashboard',compact('totalCategories','totalProducts'));
    }
}
