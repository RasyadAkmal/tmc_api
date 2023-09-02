<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(Request $request)
    {
        try {
            $data = $this->validate($request, [
                'sku' => 'required|unique:products',
                'name' => 'required|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
            ], [
                'sku.required' => 'sku is empty',
                'sku.unique' => 'sku is unique',
                'name.required' => 'name is empty',
                'name.max' => 'name length must not more than 255 characters',
                'price.required' => 'price is emppty',
                'price.min' => 'price must not negative',
                'stock.required' => 'stock is empty',
                'stock.min' => 'stock must not negative',
                'category_id.required' => 'category id is empty',
                'category_id.exists' => 'category id is invalid',
            ]);

            //Create product
            $product = $this->productService->createProduct($data);

            //Find product data for response
            $productWithCategory = Product::with('category')->find($product->id);

            $response = [
                'data' => [
                    'id' => $productWithCategory->id,
                    'sku' => $productWithCategory->sku,
                    'name' => $productWithCategory->name,
                    'price' => $productWithCategory->price,
                    'stock' => $productWithCategory->stock,
                    'category' => [
                        'id' => $productWithCategory->category->id,
                        'name' => $productWithCategory->category->name,
                    ],
                    'createdAt' => $productWithCategory->createdAt->timestamp * 1000,
                ],
            ];

            return response()->json($response, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 400);
        }
    }
}
