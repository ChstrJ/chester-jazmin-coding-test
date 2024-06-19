<?php


namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProducts()
    {

    }

    public function findProduct(int $id)
    {

    }

    public function createProduct(array $data)
    {

    }

    public function editProduct(int $id, array $data)
    {

    }

    public function deleteProduct(int $id)
    {

    }
}