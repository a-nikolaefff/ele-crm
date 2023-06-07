<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerType::create([
            'name' => 'монтажная организация',
            'is_base_type' => false
        ]);
        CustomerType::create([
            'name' => 'ген. подрядчик',
            'is_base_type' => false
        ]);
    }
}
