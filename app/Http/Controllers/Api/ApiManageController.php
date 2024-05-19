<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/05/19
 * Time: 15:28:24
 * Description: ApiManageController.php
 */

namespace App\Http\Controllers\Api;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\FileManager;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class ApiManageController extends Controller
{
    /**
     * @param array $data
     * @param string $message
     * @param bool $status
     *
     * @return [type]
     */
    protected function sendResponse($data = [], $message = '', $status = true)
    {
        $response = [
            'status' => $status,
            'data'    => $data,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * Send error response
     *
     * @param $message
     * @param array $errorTrace
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError($message, $errorTrace = [], $code = 200)
    {
        $response = [
            'status' => false,
            'message' => $message,
        ];

        if (!empty($errorTrace)) {
            $response['data'] = $errorTrace;
            $errorMessage = [];
            foreach ($errorTrace as $error) {
                $errorMessage[] = $error[0] ?? '';
            }
            $response['message'] = implode(', ', $errorMessage);
        }

        return response()->json($response, $code);
    }

    /**
     * Get Categories
     *
     * @return [type]
     */
    public function getCategories()
    {
        $categories = Category::select('id', 'name', 'created_at', 'updated_at')->get();
        return $this->sendResponse(['category' => $categories], 'Category Details');
    }

    /**
     * Get Product by categoryid
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function getProductByCategoryId(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Invalid data', $validator->errors()->toArray());
        } else {
            $products = Product::where('category_id', $request->get('category_id'))->get();
            $productList = [];
            foreach ($products as $product) {
                $productList[] = [
                    'id' => $product->id,
                    'category_id' => $product->category_id,
                    'name' =>  $product->name,
                    'description' => $product->description,
                    'image' => FileManager::getFileUrl($product->image, FileDestinations::PRODUCT_IMAGE)
                ];
            }
            return $this->sendResponse(['product' => $productList], 'Product');
        }
    }
}
