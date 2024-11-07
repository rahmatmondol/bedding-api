<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Return a standardized JSON response.
     *
     * @param string $message
     * @param string $status
     * @param bool $success
     * @param array $data
     * @param array $error
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($message = '', $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => 200,
            'success' => true,
            'data' => $data
        ]);
    }

    // for error
    public static function error($message = '', $status = 500, $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'success' => false,
            'data' => $data
        ]);
    }

    // for unauthorized
    public static function unauthorized($message = '', $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => 401,
            'success' => false,
            'data' => $data
        ]);
    }

    // for not found
    public static function notFound($message = '', $data = [])
    {
        return response()->json([
            'message' => $message,
            'status' => 404,
            'success' => false,
            'data' => $data
        ]);
    }
}
