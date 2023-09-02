<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCategory(): void
    {
        // Data kategori yang akan dibuat
        $categoryData = [
            'name' => 'Test Category',
        ];

        // Melakukan permintaan POST ke endpoint
        $response = $this->post('/api/test/categories', $categoryData);

        // Memeriksa bahwa respons memiliki status 201 (Created)
        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'name', 'createdAt']])
            ->assertJson([
                'data' => [
                    'name' => $categoryData['name'],
                ],
            ]);

        // Memastikan bahwa data kategori telah disimpan di database
        $this->assertDatabaseHas('categories', $categoryData);
    }
}
