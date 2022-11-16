<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse as HttpJsonResponse;

trait JsonResponse
{
    /**
     * @param mixed $status
     * @param null $message
     * @param null $error
     * @param null $data
     * @return HttpJsonResponse
     */
    public function jsonResponse($status, $message = null, $data = null, $error = null)
    {
        return response()->json([
            'message'   =>  $message,
            'status'    =>  $status,
            'data'      =>  $data,
            'error'     =>  $error,
        ], $status);
    }


    /**
     * @param mixed $status
     * @param null $message
     * @param null $error
     * @param null $data
     * @return HttpJsonResponse
     */
    public function jsonResponseError($status = 400, $message = null, $error = null, $data = null)
    {
        return response()->json([
            'message'   =>  $message,
            'status'    =>  $status,
            'error'     =>  $error,
            'data'      =>  $data
        ], $status);
    }
}
