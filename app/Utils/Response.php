<?php

namespace App\Utils;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Pagination\Paginator;

//created a global response for the api that uses http status code and generic message

class Response
{
    public static function collection(Paginator $data)
    {
        return response()->json(
            [
                'status' => GenericMessage::SUCCESS,
                'code' => HttpStatusCode::OK,
                'message' => GenericMessage::RETRIEVE,
                'data' => new ProductCollection($data)
            ],
            HttpStatusCode::OK
        );
    }
    public static function resource(Product $data)
    {
        return response()->json(
            [
                'status' => GenericMessage::SUCCESS,
                'code' => HttpStatusCode::OK,
                'message' => GenericMessage::FOUND,
                'data' => new ProductResource($data)
            ],
            HttpStatusCode::OK
        );
    }

    public static function created($data)
    {
        return response()->json(
            [
                'status' => GenericMessage::SUCCESS,
                'code' => HttpStatusCode::CREATED,
                'message' => GenericMessage::CREATED,
                'data' => new ProductResource($data)
            ],
            HttpStatusCode::CREATED
        );
    }

    public static function deleted()
    {
        return response()->json(
            [
                'status' => GenericMessage::SUCCESS,
                'code' => HttpStatusCode::OK,
                'message' => GenericMessage::DELETED
            ],
            HttpStatusCode::OK
        );
    }

    public static function updated(Product $data)
    {
        return response()->json(
            [
                'status' => GenericMessage::SUCCESS,
                'code' => HttpStatusCode::OK,
                'message' => GenericMessage::UPDATED,
                'data' => new ProductResource($data)
            ],
            HttpStatusCode::OK
        );
    }

    public static function invalidData()
    {
        return response()->json(
            [
                'status' => GenericMessage::ERROR,
                'code' => HttpStatusCode::UNPROCESSABLE_ENTITY,
                'message' => GenericMessage::INVALID_DATA
            ],
            HttpStatusCode::UNPROCESSABLE_ENTITY
        );
    }

    public static function notFound()
    {
        return response()->json(
            [
                'status' => GenericMessage::ERROR,
                'code' => HttpStatusCode::NOT_FOUND,
                'message' => GenericMessage::NOT_FOUND
            ],
            HttpStatusCode::NOT_FOUND
        );
    }
}