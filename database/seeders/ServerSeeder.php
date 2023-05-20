<?php

namespace Database\Seeders;

use App\Models\Server;
use App\Models\ServerDatabase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $server = [
            'info' => [
                'name' => "DDtank Splush",
                'owner_name' => "Jefferson Ataa",
                'version' => 4100
            ],
            'base' => [
                'driver' => "sqlsrv",
                'host' => "127.0.0.1",
                'port' => 1433,
                'username' => "sa",
                'password' => "123456",
                'base_user' => "Db_TankUser",
                'base_game' => "Db_TankGame"
            ]
        ];

        $serverInfo = $server['info'];
        $serverBase = $server['base'];

        if(Server::where('name', $serverInfo['name'])->exists()){
            dump('Default server already registered!');
            return;
        }

        $server = Server::create($serverInfo);
        dump($server);
        if($server){
            $serverBase['server_id'] = $server->id;
            ServerDatabase::create($serverBase);
            dump('Default server registered with success!');
        }
    }
}
