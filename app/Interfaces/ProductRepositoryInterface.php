<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts();

    public function findProduct(int $id);

    public function createProduct(array $data);

    public function editProduct(int $id, array $data);

    public function deleteProduct(int $id);
}