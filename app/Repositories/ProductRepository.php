<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function search(array $filters, $start, $size)
    {
        $query = Product::query();

        if (isset($filters['sku'])) {
            $skuValues = (array) $filters['sku'];
            $query->whereIn('sku', $skuValues);
        }

        if (isset($filters['name'])) {
            foreach ((array) $filters['name'] as $name) {
                $query->where('name', 'like', '%' . $name . '%');
            }
        }        

        if (isset($filters['price_start'])) {
            $query->where('price', '>=', $filters['price_start']);
        }

        if (isset($filters['price_end'])) {
            $query->where('price', '<=', $filters['price_end']);
        }

        if (isset($filters['stock_start'])) {
            $query->where('stock', '>=', $filters['stock_start']);
        }

        if (isset($filters['stock_end'])) {
            $query->where('stock', '<=', $filters['stock_end']);
        }
        
        if (isset($filters['category_id'])) {
            $categoryId = (array) $filters['category_id'];
            $query->whereIn('category_id', $categoryId);
        }

        if (isset($filters['category_name'])) {
            $categoryNames = (array) $filters['category_name'];
            $query->whereHas('category', function ($query) use ($categoryNames) {
                $query->whereIn('name', $categoryNames);
            });
        }        

        $total = $query->count();
        $products = $query->skip($start)->take($size)->get();

        return array(
            'product' => $products,
            'total' => $total,
        );
    }
}
