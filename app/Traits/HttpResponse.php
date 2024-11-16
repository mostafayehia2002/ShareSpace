<?php

namespace App\Traits;
use Illuminate\Http\JsonResponse;

trait HttpResponse
{
    /**
     * Return validation error response.
     *
     */

    public function returnValidationError($statusCode = 422, $error = 'Validation error'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'status' => $statusCode,
            'error' =>  $error
        ], $statusCode)->header('Accept', 'application/json');
    }

    /**
     * Return general error message response.
     */
    public function returnErrorMessage($statusCode = 500, $error = 'An error occurred'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'status' => $statusCode,
            'message' => $error,
        ], $statusCode)->header('Accept', 'application/json');
    }
    /**
     * Return success message response.
     */
    public function returnSuccessMessage($statusCode = 200, $message = 'success'): JsonResponse
    {
        return response()->json([
            'success' => true,
            'status' => $statusCode,
            'message' => $message
        ], $statusCode)->header('Accept', 'application/json');
    }
    /**
     * Return data response.
     */

    public function returnData($statusCode=200,$message="", $key = 'data', $value=[]): JsonResponse
    {
        return response()->json([
            'success' => true,
            'status' => $statusCode,
            'message'=>$message,
             $key => $value
        ], $statusCode)->header('Accept', 'application/json');
    }

    /**
     * Return paginated data response.
     */
    public function returnPaginatedData($data)
    {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => [
                    'items' => $data->items(),
                    'total' => $data->total(),
                    'currentPage' => $data->currentPage(),
                    'lastPage' => $data->lastPage(),
                    'perPage' => $data->perPage(),
                ],
            ], 200)->header('Accept', 'application/json');
        }

}

