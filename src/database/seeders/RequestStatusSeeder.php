<?php

namespace Database\Seeders;

use App\Enums\RequestStatusEnum;
use App\Models\RequestStatus;
use Illuminate\Database\Seeder;

class RequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RequestStatusEnum::cases() as $status) {
            RequestStatus::create(['name' => $status->value]);
        }
    }
}
