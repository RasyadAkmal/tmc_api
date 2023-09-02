<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function create(array $data)
    {
        return Category::create($data);
    }
}
