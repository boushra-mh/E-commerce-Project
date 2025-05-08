<?php

namespace App\Http\Controllers\API;

abstract class ApiController
{
    public function sendResponce($data = null, $message, $code = 200)
    {
        return response()->json([
            'success' => $code == 200 || 201,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function sendError($message, $code = 400)
    {
        return response()->json([
            'success' => $code == 200,
            'data' => null,
            'message' => $message,
        ], $code);
    }
}
