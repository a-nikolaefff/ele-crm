<?php

declare(strict_types=1);

namespace App\Services\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * This abstract class provides a common structure and functionality for processing request data.
 */
abstract class RequestService
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
            'received_at',
            'answered_at',
            'expected_order_date'
        );
        $this->setDirectData($inputData, $notDirectData);

        $this->setSpecificData($inputData);

        $this->setReceivedAtDate($inputData['received_at']);

        $expectedOrderDate = $inputData['expected_order_date'] ?? null;
        $this->setExpectedOrderDate($expectedOrderDate);

        $this->setUpdatedByUser();

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
    private function setDirectData(array $inputData, array $notDirectData): void
    {
        foreach ($inputData as $key => $value) {
            if (!in_array($key, $notDirectData)) {
                $this->processedData[$key] = $value;
            }
        }
    }

    /**
     * Set the received at date for the request.
     *
     * This method parses the received at date from the input data and sets it
     * in the processed data.
     *
     * @param string $receivedAt The received at date string in the format 'd.m.Y'.
     *
     * @return void
     */
    private function setReceivedAtDate(string $receivedAt): void
    {
        $this->processedData['received_at'] = Carbon::createFromFormat(
            'd.m.Y',
            $receivedAt
        );
    }

    /**
     * Set the expected order date for the request.
     *
     * This method parses the expected order date from the input data (if provided)
     * and sets it in the processed data.
     *
     * @param string|null $expectedOrderDate The expected order date string in the format 'd.m.Y' or null.
     *
     * @return void
     */
    private function setExpectedOrderDate(?string $expectedOrderDate): void
    {
        if (isset($expectedOrderDate)) {
            $this->processedData['expected_order_date']
                = Carbon::createFromFormat(
                'd.m.Y',
                $expectedOrderDate
            );
        }
    }

    private function setUpdatedByUser(): void
    {
        $this->processedData['updated_by_user_id'] = Auth::user()->id;
    }
}
