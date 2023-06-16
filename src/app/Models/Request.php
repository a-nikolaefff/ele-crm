<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Request extends Model
{
    use HasFactory, Filterable;

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
            'expected_order_date',
            'customer_id',
            'customer_employee_id',
            'project_organization_id',
            'project_organization_employee_id',
            'status_id',
            'created_by_user_id',
            'updated_by_user_id',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts
        = [
            'received_at' => 'date',
            'answered_at' => 'date',
            'expected_order_date' => 'date',
        ];

    /**
     * Get the customer associated with the request.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get the project organization associated with the request.
     *
     * @return BelongsTo
     */
    public function projectOrganization(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'project_organization_id');
    }

    public function customerEmployee(): BelongsTo
    {
        return $this->belongsTo(CustomerEmployee::class, 'customer_employee_id');
    }

    public function projectOrganizationEmployee(): BelongsTo
    {
        return $this->belongsTo(CustomerEmployee::class, 'project_organization_employee_id');
    }



    /**
     * Get current status of the request.
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(RequestStatus::class, 'status_id');
    }

    /**
     * Get the user who created the request.
     *
     * @return BelongsTo
     */
    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * Get the user who updated the request.
     *
     * @return BelongsTo
     */
    public function updatedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    /**
     * Scope a query to apply sorting to the request.
     *
     * @param Builder $query
     * @param array   $queryParams
     * @param string  $defaultSortColumn
     * @param string  $defaultSortDirection
     *
     * @return void
     */
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
                    return $query->orderBy(
                        DB::raw('YEAR(received_at)'),
                        $sortDirection
                    )
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
