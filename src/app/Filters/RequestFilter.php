<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class representing a request filter.
 */
class RequestFilter extends AbstractFilter
{
    public const STATUS_ID = 'status_id';
    public const SEARCH = 'search';
    public const CUSTOMER_ID = 'customer_id';

    protected function getCallbacks(): array
    {
        return [
            self::STATUS_ID => [$this, 'statusId'],
            self::SEARCH => [$this, 'search'],
            self::CUSTOMER_ID => [$this, 'customerId'],
        ];
    }

    /**
     * Apply the filter based on status ID.
     *
     * @param Builder $builder The Builder instance.
     * @param mixed $statusId The status ID.
     * @return void
     */
    public function statusId(Builder $builder, $statusId): void
    {
        $builder->where('status_id', $statusId);
    }

    /**
     * Apply the filter based on customer ID.
     *
     * @param Builder $builder The Builder instance.
     * @param mixed $statusId The status ID.
     * @return void
     */
    public function customerId(Builder $builder, $customerId): void
    {
        $builder->where('customer_id', $customerId)
            ->orWhere('project_organization_id', $customerId);
    }

    /**
     * Apply the filter based on search keyword.
     *
     * @param Builder $builder The Builder instance.
     * @param string $keyword The search keyword.
     * @return void
     */
    public function search(Builder $builder, $keyword): void
    {
        $builder->where(function ($query) use ($keyword) {
            $query->where('object', 'like', "%$keyword%")
                ->orWhere('equipment', 'like', "%$keyword%")
                ->orWhere('customers.name', 'like', "%$keyword%");
            });
    }
}
