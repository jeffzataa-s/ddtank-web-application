<?php

namespace App\Http\Controllers;

use App\Models\GameUserCharacter;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class GameUserController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->all(), [
            'server_id' => "required|exists:servers,id"
        ]);

        if($validator->fails())
            return $this->sendError("Validation error", $validator->errors());

        $serverId = $request->input('server_id');
        $characters = GameUserCharacter::getInfo($serverId, $request->user()->email)->get();
        return $this->sendResponse($characters, "CharacterCount: {$characters->count()}");
    }
}
