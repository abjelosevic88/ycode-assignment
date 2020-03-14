<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait ApiRequestTrait
{
    /**
     * Handle request by calling the request callback and catch any exceptions.
     *
     * @param callable  $callback   Callback function that will be handled inside try/catch block.
     * @return void
     */
    public function handleRequest(callable $callback) {
        try {
            return $callback();
        } catch (Exception $e) {
            logger()->error($e);
            return response()->json(
                [ 'message' => __('api.generic.errors.500') ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
