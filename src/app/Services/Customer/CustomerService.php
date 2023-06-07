<?php

declare(strict_types=1);

namespace App\Services\Customer;

use Illuminate\Support\Facades\Auth;

/**
 * This is an abstract service class that provides common functionality for processing customer data.
 * Subclasses must implement the setSpecificData method to define their own specific data processing logic.
 */
abstract class CustomerService
{
    /**
     * @var array The processed data after applying the data processing logic.
     */
    protected array $processedData;

    /**
     * Process the input data and return the processed data.
     *
     * @param array $inputData The input data to be processed.
     *
     * @return array The processed data.
     */
    public function processData(array $inputData): array
    {
        $this->setDirectData($inputData);
        $this->setUpdatedByUser();

        $this->setSpecificData($inputData);

        return $this->processedData;
    }

    /**
     * Set the specific data for processing.
     *
     * @param array $inputData The input data to be processed.
     *
     * @return void
     */
    protected abstract function setSpecificData($inputData): void;

    /**
     * Set the direct data without any processing.
     *
     * @param array $inputData The input data to be set as the processed data.
     *
     * @return void
     */
    private function setDirectData(array $inputData): void
    {
        $this->processedData = $inputData;
    }

    /**
     * Set the updated_by_user_id field using the currently authenticated user.
     *
     * @return void
     */
    private function setUpdatedByUser(): void
    {
        $this->processedData['updated_by_user_id'] = Auth::user()->id;
    }
}
