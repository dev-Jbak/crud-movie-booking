<?php

namespace App\Http\Helpers;

class ValidationHelpers
{
    /**
     * Gets the validation response for a list of messages
     * 
     * @param array $messages
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public static function getResponse(array $messages)
    {
        return response()->json(
            [
                'data' => [], 
                'meta' => [
                    'message' => 'The given data is invalid', 
                    'errors' => $messages
                ]
            ],
            400
        );
    }
}
