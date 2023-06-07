<?php

declare(strict_types=1);

namespace App\Services\CustomerType;

/**
 * This class provides data processing functionality for customer types.
 */
class CustomerTypeService
{
    /**
     * @var array The processed data after applying the data processing logic.
     */
    private array $processedData;

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
        $this->setNotBaseType();

        return $this->processedData;
    }

    /**
     * Set the direct data without any processing.
     *
     * This method sets the processed data by directly assigning the input data to it.
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
     * Set the "is_base_type" field to false in the processed data.
     *
     * @return void
     */
    private function setNotBaseType(): void
    {
        $this->processedData['is_base_type'] = false;
    }
}
