<?php

namespace Database\Seeders;

use App\Enums\BaseCustomerTypeEnum;
use App\Models\CustomerType;
use Illuminate\Database\Seeder;


class BaseCustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (BaseCustomerTypeEnum::cases() as $baseCustomerType) {
            CustomerType::create([
                'name' => $baseCustomerType->value,
                'is_base_type' => true
            ]);
        }
    }
}
