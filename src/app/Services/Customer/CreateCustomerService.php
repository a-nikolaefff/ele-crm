<?php

declare(strict_types=1);

namespace App\Services\Customer;

use Illuminate\Support\Facades\Auth;

/**
 * Class CreateCustomerService
 *
 * This class provides specific data processing for creating a customer.
 */
class CreateCustomerService extends CustomerService
{

    protected function setSpecificData($inputData): void
    {
        $this->setCreatedByUser();
    }

    /**
     * Set the user who created the customer.
     *
     * This method sets the "created_by_user_id" field in the processed data
     * using the ID of the authenticated user.
     *
     * @return void
     */
    private function setCreatedByUser(): void
    {
        $this->processedData['created_by_user_id'] = Auth::user()->id;
    }
}
