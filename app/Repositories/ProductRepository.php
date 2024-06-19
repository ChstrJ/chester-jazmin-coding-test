<?php


namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Utils\HttpStatusCode;
use App\Utils\Response;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProducts()
    {
        //cache it and then expires in 6 hours
        //use simple paginate because it is more light weight than paginate()
        $products = Cache::remember('products', now()->addHours(6), function () {
            Product::latest()->simplePaginate();
        });

        return Response::collection($products);
    }

    public function findProduct(int $id)
    {
        $cacheId = 'product_' . $id;

        $product = Cache::remember($cacheId, now()->addMinutes(5), function () use ($id) {
            $this->product->find($id);
        });

        if (!$product) {
            return Response::notFound();
        }
        return Response::resource($product);
    }

    public function createProduct(array $data)
    {
        $newProduct = $this->product->create($data);

        if (!$newProduct) {
            return Response::invalidData();
        }

        Cache::forget('products');
        return Response::created();
    }

    public function updateProduct(int $id, array $data)
    {
        $cacheId = 'product_' . $id;
        $updateProduct = $this->product->where('id', $id)->update($data);

        if (!$updateProduct) {
            return Response::invalidData();
        }

        Cache::forget($cacheId);
        return Response::success();

    }

    public function deleteProduct(int $id)
    {
        $cacheId = 'product_' . $id;
        $deleteProduct = $this->product->delete->id;

        if (!$deleteProduct) {
            return Response::notFound();
        }

        Cache::forget($cacheId);
        return Response::success();
    }
}