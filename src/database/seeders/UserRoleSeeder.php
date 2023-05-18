<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create(['name' => UserRole::SUPER_ADMIN_ROLE]);
        UserRole::create(['name' => UserRole::ADMIN_ROLE]);
        UserRole::create(['name' => UserRole::EMPLOYEE_ROLE]);
        UserRole::create(['name' => UserRole::STRANGER_ROLE]);
    }
}
