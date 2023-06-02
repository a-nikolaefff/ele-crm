<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\RequestStatusEnum;
use App\Models\Request;
use App\Models\RequestStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * A service class for managing requests.
 */
class RequestService
{
    /**
     * @var array
     */
    private array $requestData = [];

    /**
     * Get the request data.
     *
     * @return array
     */
    public function getRequestData(): array
    {
        return $this->requestData;
    }

    /**
     * Set the request data.
     *
     * @param array $data The validated request data.
     * @param bool  $isNewRequest Whether it is a new request or not. Default is true.
     *
     * @return void
     */
    public function setRequestData(array $data, bool $isNewRequest = true): void
    {
        $this->requestData = $data;

        $this->setReceivedAtDate();

        if ($isNewRequest) {
            $this->setNumber();
            $this->setNewRequestStatus();
        } else {
            $statusId = (int)$this->requestData['status_id'];
            if ($this->isCompletedStatus($statusId)) {
                $this->setAnsweredAtDate();
            } else if ($this->isCancelledStatus($statusId)) {
                $this->setProspectToZero();
            }
        }

        $this->setUserInformation($isNewRequest);
    }

    /**
     * Set the received at date.
     *
     * @return void
     */
    private function setReceivedAtDate(): void {
        $this->requestData['received_at'] = Carbon::createFromFormat(
            'd.m.Y',
            $this->requestData['received_at']
        );
    }

    /**
     * Set the answered at date.
     *
     * @return void
     */
    private function setAnsweredAtDate(): void {
        if (isset($this->requestData['answered_at'])) {
            $this->requestData['answered_at'] = Carbon::createFromFormat(
                'd.m.Y',
                $this->requestData['answered_at']
            );
        } else {
            $this->requestData['answered_at'] = Carbon::now();
        }
    }

    /**
     * Set the request number.
     *
     * @return void
     */
    private function setNumber(): void
    {
        $latestRequestNumber = Request::whereYear(
            'received_at',
            $this->requestData['received_at']->year
        )
            ->orderBy('number', 'desc')
            ->value('number');

        $this->requestData['number'] = $latestRequestNumber
            ? $latestRequestNumber + 1 : 1;
    }

    /**
     * Set the new request status.
     *
     * @return void
     */
    private function setNewRequestStatus(): void
    {
        $status = RequestStatus::getStatus(RequestStatusEnum::New)
            ->get()->first();
        $this->requestData['status_id'] = $status->id;
    }

    /**
     * Set the user information.
     *
     * @param bool $isNewRequest
     *
     * @return void
     */
    private function setUserInformation(bool $isNewRequest): void
    {
        $currentUserId = Auth::user()->id;
        if ($isNewRequest) {
            $this->requestData['created_by_user_id'] = $currentUserId;
        }
        $this->requestData['updated_by_user_id'] = $currentUserId;
    }

    /**
     * Set the prospect to zero.
     *
     * @return void
     */
    private function setProspectToZero(): void
    {
        $this->requestData['prospect'] = 0;
    }

    /**
     * Check if the status id is cancelled status id
     *
     * @param int $statusId The status ID.
     *
     * @return bool True if the status is cancelled, false otherwise.
     */
    private function isCancelledStatus(int $statusId): bool
    {
        $cancelledStatus = RequestStatus::getStatus(
            RequestStatusEnum::Cancelled
        )->get()->first();

        return $statusId === $cancelledStatus->id;
    }


    /**
     * Check if the status id is completed status id
     *
     * @param int $statusId The status ID.
     *
     * @return bool True if the status is completed, false otherwise.
     */
    private function isCompletedStatus(int $statusId): bool
    {
        $completedStatus = RequestStatus::getStatus(
            RequestStatusEnum::Completed
        )->get()->first();

        return $statusId === $completedStatus->id;
    }
}
