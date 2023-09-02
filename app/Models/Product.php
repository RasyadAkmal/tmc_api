<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku', 'name', 'price', 'stock', 'category_id'];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = null;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
