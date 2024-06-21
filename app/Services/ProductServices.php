<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function findProduct(int $id)
    {
        return $this->productRepository->findProduct($id);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->createProduct($data);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->productRepository->updateProduct($id, $data);
    }

    public function deleteProduct(int $id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}