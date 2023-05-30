<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CustomerFilter extends AbstractFilter
{
    public const CUSTOMER_TYPE_ID = 'customer_type_id';
    public const SEARCH = 'search';

    protected function getCallbacks(): array
    {
        return [
            self::CUSTOMER_TYPE_ID => [$this, 'typeId'],
            self::SEARCH => [$this, 'search'],
        ];
    }

    public function typeId(Builder $builder, $typeId)
    {
        $builder->where('customer_type_id', $typeId);
    }

    public function search(Builder $builder, $keyword)
    {
        $builder->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('full_name', 'like', "%$keyword%");
        });
    }
}
