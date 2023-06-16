<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerEmployee>
 */
class CustomerEmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerId = Customer::pluck('id');

        return [
            'name' => fake()->name,
            'post' => fake()->word,
            'email' => fake()->email,
            'phone' => fake('US')->e164PhoneNumber,
            'customer_id' => $customerId->random(),
        ];
    }
}
