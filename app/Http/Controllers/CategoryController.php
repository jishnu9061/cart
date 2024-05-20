<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/05/19
 * Time: 10:41:11
 * Description: CategoryController.php
 */

namespace App\Http\Controllers;

use App\Http\Helpers\ToastrHelper;

use App\Models\Category;
use App\Models\Product;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    /**
     * Category List
     *
     * @return [type]
     */
    public function index()
    {
        $categories = Category::select('id', 'name', 'created_at')->get();
        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * @return [type]
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * @param CategoryStoreRequest $request
     *
     * @return [type]
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.category.index');
    }

    /**
     * Edit Category
     *
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     */
    public function edit(Category $category)
    {
        return view('pages.admin.category.edit', compact('category'));
    }

    /**
     * Update Category
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index');
    }

    /**
     * @param Category $category
     *
     * @return [type]
     */
    public function delete(Category $category)
    {
        try {
            $productExist = Product::where('category_id', $category->id)->exists();
            if ($productExist) {
                return Response::json(['error' => 'Category cannot be deleted because it has associated products'], 400);
            }
            $category->delete();
            return Response::json(['success' => 'Category Deleted Successfully']);
        } catch (\Exception $e) {
            return Response::json(['error' => 'An error occurred while deleting the category: ' . $e->getMessage()], 500);
        }
    }
}
