<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchProducts(): void
    {
        // Skenario 1: Pencarian dengan SKU yang ditemukan
        $response = $this->get('/api/test/search?sku=123');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);

        // Skenario 2: Pencarian dengan Nama Produk
        $response = $this->get('/api/test/search?name=Product Name');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);

        // Skenario 3: Pencarian dengan Rentang Harga
        $response = $this->get('/api/test/search?price_start=500&price_end=1500');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);

        // Skenario 4: Pencarian dengan Rentang Stok
        $response = $this->get('/api/test/search?stock_start=50&stock_end=100');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);

        // Skenario 5: Pencarian dengan Kategori
        $response = $this->get('/api/test/search?category_id=1');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);

        // Skenario 6: Pencarian Tanpa Parameter
        $response = $this->get('/api/test/search');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);

        // Skenario 7: Pencarian dengan Pagination
        $response = $this->get('/api/test/search?page=2');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);

        // Skenario 8: Pencarian dengan Parameter Gabungan
        $response = $this->get('/api/test/search?sku=123&name=Product&price_start=500&price_end=1500');
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [], 'paging' => ['size', 'total', 'current']]);
    }
}
