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

    public function testCreateProduct()
    {

        $data = [
            'name' => 'test',
            'description' => 'test',
            'price' => 6.90
        ];

        $response = $this->postJson('/api/products', $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'Product name',
                    'Product description',
                    'Product price',
                    'Created at',
                    'Updated at'
                ]
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'Product created successfully.',
                'data' => [
                    'Product name' => 'test',
                    'Product description' => 'test',
                    'Product price' => 6.9
                ]
            ]);
    }

   

}
