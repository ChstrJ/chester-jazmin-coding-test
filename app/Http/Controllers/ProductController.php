<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductRepository $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return $this->productService->getAllProducts();
    }

    public function store(StoreProductRequest $request)
    {
        return $this->productService->createProduct($request->validated());
    }
    public function show(int $id)
    {
        return $this->productService->findProduct($id);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return $this->productService->updateProduct($product->id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->productService->deleteProduct($id);
    }
}
