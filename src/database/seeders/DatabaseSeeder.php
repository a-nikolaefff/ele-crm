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
        $seeders = [
            UserRoleSeeder::class,
            SuperAdminSeeder::class,
            RequestStatusSeeder::class,
            BaseCustomerTypeSeeder::class
        ];
        $appEnv = config('app.env');
        if($appEnv === 'development') {
            $seeders[] = UserSeeder::class;
            $seeders[] = CustomerSeeder::class;
            $seeders[] = CustomerTypeSeeder::class;
        }
        $this->call($seeders);
    }
}
