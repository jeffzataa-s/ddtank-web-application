<?php

namespace App\Http\Controllers;

use App\Models\Server;

class ServerController extends Controller
{
    public function index(){
        $servers = Server::all();
        return response()->json($servers);
    }
}
