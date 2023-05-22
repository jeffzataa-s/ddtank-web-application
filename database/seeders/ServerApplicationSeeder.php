<?php

namespace Database\Seeders;

use App\Models\Server;
use App\Models\ServerApplication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServerApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applications = [
            [
                'key' => "quest_url",
                'url' => "https://quest.splush.com.br/",
                'ssl_verify' => false
            ],
            [
                'key' => "center_soap",
                'url' => "http://127.0.0.1:2009/?wsdl",
                'ssl_verify' => false
            ],
            [
                'key' => "payment_api",
                'url' => "https://gateway.splush.com.br/",
                'ssl_verify' => false
            ]
        ];

        foreach($applications as $application){
            $application['server_id'] = Server::first()->id;
            if(ServerApplication::where('key', $application['key'])->exists()){
                dump("Application [{$application['key']}] already registered!");
                continue;
            }

            ServerApplication::create($application);
            dump("Application [{$application['key']}] has been registered!");
        }
    }
}
