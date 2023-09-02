<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(Request $request)
    {
        try {
            $data = $this->validate($request, [
                'name' => 'required|max:255',
            ], [
                'name.required' => 'name is empty',
                'name.max' => 'name length must not more than 255 characters'
            ]);

            //Create category
            $category = $this->categoryService->createCategory($data);

            $response = [
                'data' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'createdAt' => $category->createdAt->timestamp * 1000
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