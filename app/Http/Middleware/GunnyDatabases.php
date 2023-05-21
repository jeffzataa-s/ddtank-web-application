<?php

namespace App\Http\Middleware;

use App\Models\Server;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class GunnyDatabases
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $servers = Server::all();
        foreach($servers as $server){
            $database = $server->database;
            if($database){
                Config::set("database.connections.{$database->base_user}_{$server->id}", [
                    'driver' => $database->driver,
                    'host' => $database->host,
                    'port' => $database->port,
                    'username' => $database->username,
                    'password' => $database->password,
                    'database' => $database->base_user,
                    'charset' => "utf8",
                    'strict' => true,
                    'prefix_indexes' => true,
                    'prefix' => '',
                    'engine' => null
                ]);

                Config::set("database.connections.{$database->base_game}_{$server->id}", [
                    'driver' => $database->driver,
                    'host' => $database->host,
                    'port' => $database->port,
                    'username' => $database->username,
                    'password' => $database->password,
                    'database' => $database->base_game,
                    'charset' => "utf8",
                    'strict' => true,
                    'prefix_indexes' => true,
                    'prefix' => '',
                    'engine' => null
                ]);
            }
        }

        return $next($request);
    }
}
