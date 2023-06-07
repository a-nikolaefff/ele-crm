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

    protected function getCallbacks(): array
    {
        return [
            self::STATUS_ID => [$this, 'statusId'],
            self::SEARCH => [$this, 'search'],
        ];
    }

    /**
     * Apply the filter based on status ID.
     *
     * @param Builder $builder The Builder instance.
     * @param mixed $statusId The status ID.
     * @return void
     */
    public function statusId(Builder $builder, $statusId)
    {
        $builder->where('status_id', $statusId);
    }

    /**
     * Apply the filter based on search keyword.
     *
     * @param Builder $builder The Builder instance.
     * @param string $keyword The search keyword.
     * @return void
     */
    public function search(Builder $builder, $keyword)
    {
        $builder->where(function ($query) use ($keyword) {
            $query->where('object', 'like', "%$keyword%")
                ->orWhere('equipment', 'like', "%$keyword%")
                ->orWhere('customers.name', 'like', "%$keyword%");
            });
    }
}
