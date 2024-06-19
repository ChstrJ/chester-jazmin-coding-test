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

    public function __construct(ProductRepository $productService) {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return $this->productService->getAllProducts();
    }

    public function store(StoreProductRequest $request)
    {
        $validated_data = $request->validated();

        $data = Product::create($validated_data);

        return response()->json(new ProductResource($data), 200);
        
    }
    public function show(int $id)
    {
        $product = Product::find($id);
        if(!$product) {
            return response()->json("Prodct Not Found", 404);
        }

        return response()->json(new ProductResource($product), 200);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $updated_data = $request->validated();
        $product->update($updated_data);
        return response()->json($product, 200);
    }

    public function destroy(int $id)
    {
        $product = Product::find($id);
        if(!$product) {
            return response()->json("Prodct Not Found", 404);
        }
        $product->delete();
        return response()->json('1');
    }
}
