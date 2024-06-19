<?php

namespace App\Utils;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

//created a global response for the api that uses http status code and http message class

class Response
{
    public static function collection(array $data) {
        return response()->json(new ProductCollection($data), HttpStatusCode::OK);
    }

    public static function resource(array $data) {
        return response()->json(new ProductResource($data), HttpStatusCode::OK);
    }

    public static function created()
    {
        return response()->json([HttpStatusMessage::CREATED], HttpStatusCode::CREATED);
    }

    public static function notFound()
    {
        return response()->json([HttpStatusMessage::NOT_FOUND], HttpStatusCode::NOT_FOUND);
    }
}