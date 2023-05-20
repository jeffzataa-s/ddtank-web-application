<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => "is_private_ddt",
                'value' => true
            ]
        ];

        foreach($data as $parameter){
            $key = $parameter['key'];
            if(Parameter::where('key', $key)->exists()){
                dump("Parameter: {{$key}} already exists!");
                continue;
            }
            
            Parameter::create($parameter);
            dump("Parameter: {$key} has been created!");
        }
    }
}
