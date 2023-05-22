<?php

namespace App\Http\Controllers;

use App\Facades\CenterServiceFacade;
use App\Models\Server;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function loadingAuth(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'server_id' => "required|exists:servers,id"
            ]);

            if ($validator->fails())
                return $this->sendError("Validation error", $validator->errors());

            $serverId = $request->input('server_id');
            $serverInfo = Server::find($serverId);

            $authorization = CenterServiceFacade::authorizeUser($serverInfo, auth()->user());
            if($authorization['state'] != 0)
                return $this->sendError('Login failure', ['message' => "Invalid access token!"]);

            $success['time'] = time();
            $success['token'] = $authorization['key'];
            return $this->sendResponse($success, 'Login successfuly!');
        } catch (Exception $ex) {
            $this->exceptionLog($ex);
            return $this->sendError('Internal error', [$ex->getMessage()], 500);
        }
    }
}
