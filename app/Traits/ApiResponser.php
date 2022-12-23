<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    /**
     * Build a successful response
     *
     * @param    $data
     * @param  string|null  $message
     * @param  int  $code
     * @return JsonResponse
     */
    protected function successResponse($data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Build an error response
     *
     * @param  array|string  $message
     * @param  int  $code
     * @return JsonResponse
     */
    protected function errorResponse(array|string $message, int $code): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
        ], $code);
    }
}
