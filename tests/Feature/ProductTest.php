<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllProducts()
    {
        Product::factory()->count(15)->create();
        $response = $this->getJson('/api/products');
        $response->assertStatus(200)->assertJsonCount(15, 'data');
    }

    

}
