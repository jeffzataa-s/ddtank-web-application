<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($result, $message){
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $messages = [], $code = 404){
        $response = [
            'success' => false,
            'message' => $error
        ];

        if(!empty($messages))
            $response['data'] = $messages;

        return response()->json($response, $code);
    }

    public function exceptionLog(Exception $ex){
        Log::error("{$ex->getMessage()} in {$ex->getFile()}, line: {$ex->getLine()}");
    }
}
