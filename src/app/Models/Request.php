<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Request extends Model
{
    use Filterable;

    /**
     * The name of the table in the database
     *
     * @var string
     */
    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'number',
            'object',
            'equipment',
            'comment',
            'prospect',
            'received_at',
            'answered_at',
            'customer_id',
            'project_organization_id',
            'status_id',
            'created_by_user_id',
            'updated_by_user_id',
        ];

    protected $casts
        = [
            'received_at' => 'date',
            'answered_at' => 'date',
        ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function projectOrganization(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'project_organization_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(RequestStatus::class, 'status_id');
    }

    public function scopeSort(
        Builder $query,
        array $queryParams,
        string $defaultSortColumn = '',
        string $defaultSortDirection = 'asc'
    ): void {
        $sortColumn = $queryParams['sort'] ?? $defaultSortColumn;
        $sortDirection = $queryParams['direction'] ?? $defaultSortDirection;
        $query->when(
            !empty($sortColumn),
            function ($query) use ($sortColumn, $sortDirection) {
                if ($sortColumn === 'number') {
                    return $query->orderBy(DB::raw('YEAR(received_at)'), $sortDirection)
                        ->orderBy($sortColumn, $sortDirection);
                }
                if ($sortColumn === 'customer') {
                    return $query->orderBy('customers.name', $sortDirection);
                }
                return $query->orderBy($sortColumn, $sortDirection);
            }
        );
    }
}
