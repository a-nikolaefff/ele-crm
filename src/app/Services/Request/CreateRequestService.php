<?php

declare(strict_types=1);

namespace App\Services\Request;

use App\Enums\RequestStatusEnum;
use App\Models\Request;
use App\Models\RequestStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreateRequestService
 *
 * This class provides specific data processing logic for creating a new request.
 */
class CreateRequestService extends RequestService
{
    protected function setSpecificData($inputData): void
    {
        $this->setNumber($inputData['received_at']);
        $this->setNewRequestStatus();
        $this->setCreatedByUser();
    }

    /**
     * Set the request number.
     *
     * @param string $receivedAt The received at date string in the format 'd.m.Y'.
     * @return void
     */
    private function setNumber(string $receivedAt): void
    {
        $receivedAtDate = Carbon::createFromFormat('d.m.Y', $receivedAt);

        $latestRequestNumber = Request::whereYear(
            'received_at',
            $receivedAtDate->year
        )
            ->orderBy('number', 'desc')
            ->value('number');

        $this->processedData['number'] = $latestRequestNumber
            ? $latestRequestNumber + 1 : 1;
    }

    /**
     * Set the new request status.
     *
     * This method retrieves the new request status from the database
     * and sets its ID in the processed data.
     *
     * @return void
     */
    private function setNewRequestStatus(): void
    {
        $status = RequestStatus::getStatus(RequestStatusEnum::New)
            ->get()->first();
        $this->processedData['status_id'] = $status->id;
    }

    /**
     * Set the user who created the request.
     *
     * This method sets the ID of the currently authenticated user
     * as the created by user ID in the processed data.
     *
     * @return void
     */
    private function setCreatedByUser(): void
    {
        $this->processedData['created_by_user_id'] = Auth::user()->id;
    }
}
