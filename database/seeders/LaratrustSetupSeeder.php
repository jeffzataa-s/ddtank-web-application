<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaratrustSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            [
                'name' => "superadmin",
                'display_name' => "Super Administrator",
                'description' => "User is the Super Admin of a given project"
            ],
            [
                'name' => "admin",
                'display_name' => "Administrator",
                'description' => "User is the Admin of a given project"
            ],
            [
                'name' => "gamemaster",
                'display_name' => "Game Master",
                'description' => "User is the GameMaster of a given project"
            ],
            [
                'name' => "support",
                'display_name' => "Support",
                'description' => "User is the Support of a given project"
            ],
            [
                'name' => "youtuber",
                'display_name' => "Youtuber",
                'description' => "User is the Youtube of a given project"
            ],
            [
                'name' => "customer",
                'display_name' => "Customer",
                'description' => "User is the customer of a given project"
            ]
        ];

        
        foreach ($rules as $rule) {
            if (!Role::where('name', $rule['name'])->exists()) {
                Role::create($rule);
            }
        }
    }
}
