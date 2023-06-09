<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class representing a customer filter.
 */
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

    /**
     * Apply the filter based on customer type ID.
     *
     * @param Builder $builder The Builder instance.
     * @param mixed $typeId The customer type ID.
     * @return void
     */
    public function typeId(Builder $builder, string $typeId)
    {
        if ($typeId === 'none') {
            $builder->where('customer_type_id', null);
        } else {
            $builder->where('customer_type_id', $typeId);
        }
    }

    /**
     * Apply the filter based on search keyword.
     *
     * @param Builder $builder The Builder instance.
     * @param string $keyword The search keyword.
     * @return void
     */
    public function search(Builder $builder, string $keyword)
    {
        $builder->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('full_name', 'like', "%$keyword%");
        });
    }
}
