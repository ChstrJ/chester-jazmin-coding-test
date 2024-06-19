<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        //we can apply here some business logic
        return $this->productRepository->getAllProducts();
    }

    public function findProduct(int $id)
    {
        return $this->productRepository->findProduct($id);
    }
}