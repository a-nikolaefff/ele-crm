<?php

namespace Database\Seeders;

use App\Models\CustomerEmployee;
use Illuminate\Database\Seeder;

class CustomerEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerEmployee::factory()->count(100)->create();
    }
}
