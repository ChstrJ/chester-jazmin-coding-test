<?php

namespace App\Interfaces;


interface ProductRepositoryInterface
{
    public function getAllProducts();

    public function findProduct(int $id);

    public function createProduct(array $data);

    public function updateProduct(int $id, array $data);

    public function deleteProduct(int $id);
}