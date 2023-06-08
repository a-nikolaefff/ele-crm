<?php

declare(strict_types=1);

namespace App\Services\Customer;

use App\Enums\BaseCustomerTypeEnum;
use App\Models\CustomerType;
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
        $notDirectData = array(
            'has_project_department',
        );
        $this->setDirectData($inputData, $notDirectData);

        $this->setHasProjectDepartment($inputData);

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
     * Set the direct data from the input data, excluding specific keys.
     *
     * @param array $inputData The input data array.
     * @param array $notDirectData The array of keys to exclude from direct data setting.
     *
     * @return void
     */
    private function setDirectData(array $inputData, array $notDirectData): void
    {
        foreach ($inputData as $key => $value) {
            if (!in_array($key, $notDirectData)) {
                $this->processedData[$key] = $value;
            }
        }
    }

    public function setHasProjectDepartment(array $inputData): void
    {
        $projectOrganizationTypeId = CustomerType::getBaseCustomerType(
            BaseCustomerTypeEnum::ProjectOrganization
        )->get()->first()->id;

        if ((int)$inputData['customer_type_id'] === $projectOrganizationTypeId) {
            $this->processedData['has_project_department'] = true;
        } else {
            $this->processedData['has_project_department']
                = isset($inputData['has_project_department']);
        }
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
