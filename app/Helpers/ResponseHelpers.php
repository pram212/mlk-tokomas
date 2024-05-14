<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Response;


class ResponseHelpers
{
    public static function formatResponse($message, $data = [],$status_code=200,$status=true)
    {
        return Response::json([
            'status' => $status, // boolean
            'status_code' => $status_code, // integer
            'message' => $message, // string
            'data' => $data // array
        ]);
    }
}
