<?php

namespace Database\Factories;

use App\Models\CustomerType;
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
        $allowableTypeId = CustomerType::all()->pluck('id');

        $name = fake()->company;
        return [
            'name' => $name,
            'full_name' => $name,
            'customer_type_id' => $allowableTypeId->random(),
        ];
    }
}
