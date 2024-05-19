<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/05/19
 * Time: 11:42:37
 * Description: ProductController.php
 */

namespace App\Http\Controllers;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\FileManager;

use App\Models\Product;
use App\Models\Category;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ProductController extends Controller
{
    /**
     * Product List
     *
     * @return [type]
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'created_at')->get();
        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * @return [type]
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('pages.admin.product.create', compact('categories'));
    }

    /**
     * @param ProductStoreRequest $request
     *
     * @return [type]
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $res = FileManager::upload(FileDestinations::PRODUCT_IMAGE, 'image', FileManager::FILE_TYPE_IMAGE);
            if ($res['status']) {
                $product->image = $res['data']['fileName'];
                $product->save();
            }
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Edit Product
     *
     * @param Product $product
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id');
        return view('pages.admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update Product
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $res = FileManager::upload(FileDestinations::PRODUCT_IMAGE, 'image', FileManager::FILE_TYPE_IMAGE);
            if ($res['status']) {
                $product->image = $res['data']['fileName'];
                $product->save();
            }
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Delete Category
     *
     * @param Category $category
     *
     * @return [type]
     */
    public function delete(Product $product)
    {
        $product->delete();
        return Response::json(['success' => 'Category Deleted Successfully']);
    }
}
