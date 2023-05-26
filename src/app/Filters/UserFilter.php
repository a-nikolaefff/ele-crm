<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    public const ROLE_ID = 'role_id';
    public const SEARCH = 'search';

    protected function getCallbacks(): array
    {
        return [
            self::ROLE_ID => [$this, 'roleId'],
            self::SEARCH => [$this, 'search'],
        ];
    }

    public function roleId(Builder $builder, $roleId)
    {
        $builder->where('role_id', $roleId);
    }

    public function search(Builder $builder, $keyword)
    {
        $builder->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%");
        });
    }
}
