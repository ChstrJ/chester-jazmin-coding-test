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

    public function testUpdateProduct()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'update test',
            'description' => 'update test',
            'price' => 69.90
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updatedData);
        $response->assertStatus(200)
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
                'message' => 'Product updated successfully.',
                'data' => [
                    'Product name' => 'update test',
                    'Product description' => 'update test',
                    'Product price' => 69.90
                ]
            ]);
    }

    public function testDeleteProduct()
    {
        $product = Product::factory()->create();
        $response = $this->deleteJson("/api/products/{$product->id}");
        $response->assertStatus(200);
    }

    public function testFindProduct()
    {
        $product = Product::factory()->create();
        $response = $this->getJson("/api/products/{$product->id}");
        $response->assertStatus(200);
    }

   

}
