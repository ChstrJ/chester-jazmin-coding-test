<?php

namespace App\Utils;

use App\Http\Resources\ProductResource;
use App\Models\Product;

//created a global response for the api that uses http status code and generic message

class Response
{
    public static function resource(Product $data)
    {
        return response()->json(
            [
                'status'  => GenericMessage::SUCCESS,
                'message' => GenericMessage::FOUND,
                'data'    => new ProductResource($data)
            ],
            HttpStatusCode::OK
        );
    }

    public static function created($data)
    {
        return response()->json(
            [
                'status'  => GenericMessage::SUCCESS,
                'message' => GenericMessage::CREATED,
                'data'    => new ProductResource($data)
            ],
            HttpStatusCode::CREATED
        );
    }

    public static function deleted()
    {
        return response()->json(
            [
                'status'  => GenericMessage::SUCCESS,
                'message' => GenericMessage::DELETED
            ],
            HttpStatusCode::OK
        );
    }

    public static function updated(Product $data)
    {
        return response()->json(
            [
                'status'  => GenericMessage::SUCCESS,
                'message' => GenericMessage::UPDATED,
                'data'    => new ProductResource($data)
            ],
            HttpStatusCode::OK
        );
    }

    public static function invalidData()
    {
        return response()->json(
            [
                'status'  => GenericMessage::ERROR,
                'message' => GenericMessage::NOT_FOUND
            ],
            HttpStatusCode::UNPROCESSABLE_ENTITY
        );
    }

    public static function notFound()
    {
        return response()->json(
            [
                'status'  => GenericMessage::ERROR,
                'message' => GenericMessage::NOT_FOUND
            ],
            HttpStatusCode::NOT_FOUND
        );
    }
}