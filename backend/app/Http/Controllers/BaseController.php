<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public function sendResponse(mixed $result, string $message = null): JsonResponse
    {
        $response = $result;
        is_null($message) ?: $response['message'] = $message;

        return response()->json(['data' => $result]);
    }

    public function sendError(string $error, int $code = 404): JsonResponse
    {
        $response = [
            'message' => $error,
        ];

        return response()->json($response, $code);
    }
}
