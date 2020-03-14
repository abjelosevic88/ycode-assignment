<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
            // NOTES :: Transations are totally unnecessary for this assignment :)
            //          However, I will put it just for possible future task(s), since
            //          this is generic handler function after all.
            DB::beginTransaction();
            $computedValue = $callback();
            DB::commit();

            return $computedValue;
        } catch (Exception $e) {
            logger()->error($e);
            DB::rollBack();
            return response()->json(
                [ 'message' => __('api.generic.errors.500') ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
