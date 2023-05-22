<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /** Create default roles */
        $this->call(LaratrustSetupSeeder::class);

        /** Create default super-admin users */
        $this->call(UserSeeder::class);

        /** Create default application params */
        $this->call(ParameterSeeder::class);

        /** Create default game database */
        $this->call(ServerSeeder::class);

        /** Create default game application params */
        $this->call(ServerApplicationSeeder::class);
    }
}
