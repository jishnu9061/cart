<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/05/19
 * Time: 21:36:37
 * Description: CartController.php
 */

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Show product list
     *
     * @return [type]
     */
    public function productList()
    {
        $products = Product::select('id', 'name', 'category_id', 'description', 'image', 'created_at')->get();
        return view('pages.web.index', compact('products'));
    }

    /**
     * Add Product To Cart
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function addToCart(Request $request)
    {
        $productId = $request->input('id');
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]++;
        } else {
            $cart[$productId] = 1;
        }
        Session::put('cart', $cart);
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    /**
     * Get Cart
     *
     * @return [type]
     */
    public function getCart()
    {
        $cart = Session::get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return response()->json(['cart' => $cart, 'products' => $products]);
    }
}
