<?php

namespace Database\Seeders;

use App\Enums\BaseCustomerTypeEnum;
use App\Enums\RequestStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\CustomerType;
use App\Models\RequestStatus;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
