<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $infos = [
            [
                'name' => "Jefferson Ataa",
                'email' => "jefferson@base.local",
                'password' => bcrypt('321321321')
            ],
            [
                'name' => "Gabriel Luiz",
                'email' => "gabriel@base.local",
                'password' => bcrypt('321321321')
            ]
        ];

        foreach ($infos as $info) {
            if (User::where('email', $info['email'])->exists()) {
                dump("Admin [{$info['email']}] already exists!");
                continue;
            }

            $user = User::create($info);
            if ($user) {
                $user->addRole(Role::ROLE_SUPERADMIN);
                dump("Admin [{$info['email']}] registered with success!");
            }
        }
    }
}
