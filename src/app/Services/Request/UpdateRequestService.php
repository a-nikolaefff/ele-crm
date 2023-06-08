<?php

declare(strict_types=1);

namespace App\Services\Request;

use App\Enums\RequestStatusEnum;
use App\Models\RequestStatus;
use Carbon\Carbon;

/**
 * Class UpdateRequestService
 *
 * This class provides specific data processing logic for updating a request.
 */
class UpdateRequestService extends RequestService
{

    protected function setSpecificData($inputData): void
    {
        $status = RequestStatus::find((int)$inputData['status_id']);

        switch ($status->name) {

            case(RequestStatusEnum::Completed->value):
                $this->setAnsweredAtDate($inputData['answered_at']);
                break;

            case(RequestStatusEnum::Success->value):
                $this->setAnsweredAtDate($inputData['answered_at']);
                $this->setProspectToZero();
                break;

            case(RequestStatusEnum::Cancelled->value):
                $this->setAnsweredAtDate(null);
                $this->setProspectToZero();
                break;

            default:
                $this->setAnsweredAtDate(null);
        }
    }

    /**
     * Set the answered at date.
     *
     * This method sets the answered at date in the processed data, based on the provided input.
     * If the answered at date is not provided, it sets it to null.
     *
     * @param string|null $answeredAt The answered at date string in the format 'd.m.Y', or null if not provided.
     *
     * @return void
     */
    private function setAnsweredAtDate(?string $answeredAt): void
    {
        if (isset($answeredAt)) {
            $this->processedData['answered_at'] = Carbon::createFromFormat(
                'd.m.Y',
                $answeredAt
            );
        } else {
            $this->processedData['answered_at'] = null;
        }
    }

    /**
     * Set the prospect to zero.
     *
     * This method sets the prospect value to zero in the processed data.
     *
     * @return void
     */
    private function setProspectToZero(): void
    {
        $this->processedData['prospect'] = 0;
    }
}
