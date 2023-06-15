<?php

namespace Database\Factories;

use App\Enums\BaseCustomerTypeEnum;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\RequestStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerId = Customer::pluck('id');

        $projectOrganizationTypeId = CustomerType::getBaseCustomerType(
            BaseCustomerTypeEnum::ProjectOrganization
        )->get()->first()->id;

        $projectOrganizationId = Customer::where('customer_type_id',
            $projectOrganizationTypeId)->pluck('id');

        $statusId = RequestStatus::pluck('id');

        $usersId = User::pluck('id');

        $numbers = fake()->unique()->numberBetween(0, 100);

        $collection = collect($numbers);

        $prospect = collect([0,1,2,3,4,5]);

        return [
            'number' => $collection->random(),
            'received_at' => Carbon::now(),
            'answered_at'=> Carbon::now(),
            'expected_order_date' => Carbon::now(),
            'object' => fake()->word,
            'equipment' => fake()->word,
            'comment' => fake()->word,
            'customer_id' => $customerId->random(),
            'project_organization_id' => $projectOrganizationId->random(),
            'prospect' => $prospect->random(),
            'status_id' => $statusId->random(),
            'created_by_user_id' => $usersId->random(),
            'updated_by_user_id' => $usersId->random(),
        ];
    }
}
