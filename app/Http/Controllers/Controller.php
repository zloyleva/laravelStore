<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $defaultResponse
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($defaultResponse = ['message' => 'Done.'], $status = 200, $headers=[])
    {
        $headers = array_merge($headers, [ 'Content-Type' => 'application/json; charset=utf-8' ]);
        return response()->json($defaultResponse, $status, $headers, JSON_UNESCAPED_UNICODE);
    }

}
