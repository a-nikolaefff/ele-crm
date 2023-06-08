<?php

namespace Database\Factories;

use App\Enums\BaseCustomerTypeEnum;
use App\Enums\UserRoleEnum;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerTypeId = CustomerType::pluck('id');

        $superAdminId = User::select('users.*')
            ->leftjoin(
                'user_roles as user_roles',
                'users.role_id',
                '=',
                'user_roles.id'
            )->where('user_roles.name', UserRoleEnum::SuperAdmin->value)
            ->value('id');

        $name = fake()->company;

        return [
            'name' => $name,
            'full_name' => $name,
            'customer_type_id' => $customerTypeId->random(),
            'has_project_department' => fake()->boolean,
            'contact_person' => fake()->name,
            'post' => fake()->word,
            'email' => fake()->email,
            'phone' => fake('US')->e164PhoneNumber,
            'website' => fake()->url,
            'created_by_user_id' => $superAdminId,
            'updated_by_user_id' => $superAdminId,
        ];
    }
}
