<?php 

namespace App\Utils;


class Response {

    public function success() {
        return response()->json([HttpStatusMessage::CREATED], HttpStatusCode::CREATED);
    }

    public function notFound() {
        return response()->json([HttpStatusMessage::NOT_FOUND], HttpStatusCode::NOT_FOUND);
    }
}