<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

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

    public function statusId(Builder $builder, $statusId)
    {
        $builder->where('status_id', $statusId);
    }

    public function search(Builder $builder, $keyword)
    {
        $builder->where(function ($query) use ($keyword) {
            $query->where('object', 'like', "%$keyword%")
                ->orWhere('equipment', 'like', "%$keyword%")
                ->orWhere('customers.name', 'like', "%$keyword%");
            });
    }
}
