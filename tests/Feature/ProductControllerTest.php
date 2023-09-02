<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProduct(): void
    {
        // Membuat kategori baru menggunakan factory
        $category = Category::factory()->create();

        // Data produk yang akan dibuat
        $productData = [
            'sku' => '123',
            'name' => 'Test Product',
            'price' => 1000,
            'stock' => 10,
            'category_id' => $category->id,
        ];

        // Melakukan permintaan POST ke endpoint
        $response = $this->post('/api/test/products', $productData);

        // Memeriksa bahwa respons memiliki status 201 (Created)
        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['sku', 'name', 'price', 'stock', 'category', 'createdAt']])
            ->assertJson([
                'data' => [
                    'sku' => $productData['sku'],
                    'name' => $productData['name'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'category' => [
                        'id' => $category->id,
                        'name' => $category->name,
                    ],
                ],
            ]);

        // Memastikan bahwa data produk telah disimpan di database
        $this->assertDatabaseHas('products', $productData);
    }
}
