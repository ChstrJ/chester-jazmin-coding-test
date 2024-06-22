<?php


namespace App\Repositories;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
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
        //cache it per page and then set it to 6 hours
        $page = request('page', 1);
        $cachePage = 'products_page_' . $page;

        //check if the products are cached then get the cache data else remember the cache page
        if (Cache::has($cachePage)) {
            $products = Cache::get($cachePage);
        } else {
            $products = Cache::remember($cachePage, now()->addHours(6), function () {
                return Product::latest()->simplePaginate();
            });
        }

        return Response::collection($products);
    }

    public function findProduct(int $id)
    {
        $cacheId = 'product_' . $id;

        //chech if the product is already cache then get the cache data else remember the cache page
        if (Cache::has($cacheId)) {
            $product = Cache::get($cacheId);
        }

        $product = Cache::remember($cacheId, now()->addHours(6), function () use ($id) {
            return $this->product->find($id);
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

        //clear all the cache data when new product is added
        Cache::flush();
        return Response::created($newProduct);
    }

    public function updateProduct(int $id, array $data)
    {
        $cacheId = 'product_' . $id;
        $updateProduct = $this->product->where('id', $id)->update($data);

        if (!$updateProduct) {
            return Response::invalidData();
        }

        //clear the cache of the updated product
        Cache::forget($cacheId);

        //get the updated product
        $productId = $this->product->find($id);

        //put the updated product in cache
        Cache::put($cacheId, $productId, now()->addHours(6));
        return Response::updated($productId);
    }

    public function deleteProduct(int $id)
    {
        $cacheId = 'product_' . $id;
        $product = $this->product->find($id);

        if (!$product) {
            return Response::notFound();
        }
        //delete the product
        $product->delete();

        //clear the cache of the deleted product
        Cache::forget($cacheId);
        return Response::deleted();
    }
}