<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function searchProducts(array $filters, $start, $size)
    {
        return $this->productRepository->search($filters, $start, $size);
    }
}
