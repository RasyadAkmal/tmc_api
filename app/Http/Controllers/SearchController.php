<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Exception;

class SearchController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        try {
            $page = $request->input('page', 1); //Current page
            $size = 10; //Pagination size
            $start = ($page - 1) * $size; //Set offset value

            //Get products data
            $products = $this->productService->searchProducts($request->all(), $start, $size);

            $productData = ProductResource::collection($products['product']);
            $totalProducts = $products['total'];

            $paging = [
                'size' => $size,
                'total' => ceil($totalProducts / $size),
                'current' => $page
            ];

            return response()->json([
                'data' => $productData,
                'paging' => $paging,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ], 400);
        }
    }
}
