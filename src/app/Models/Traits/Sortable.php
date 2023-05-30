<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Sortable
{

    /**
     * @param Builder $query
     * @param array   $queryParams
     *
     * @return void
     */
    public function scopeSort(
        Builder $query,
        array $queryParams,
    ): void {
        $sortColumn = $queryParams['sort'] ?? '';
        $sortDirection = $queryParams['direction'] ?? 'asc';
        $query->when(
            !empty($sortColumn),
            function ($query) use ($sortColumn, $sortDirection) {
                return $query->orderBy($sortColumn, $sortDirection);
            }
        );
    }
}
