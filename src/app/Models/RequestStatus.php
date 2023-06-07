<?php

namespace App\Models;

use App\Enums\RequestStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RequestStatus extends Model
{
    /**
     * The name of the table in the database
     *
     * @var string
     */
    protected $table = 'request_statuses';

    /**
     * Get the requests associated with the status.
     *
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'status_id');
    }

    /**
     * Scope a query to get the status by the given status enum.
     *
     * @param Builder $query
     * @param RequestStatusEnum $status
     *
     * @return void
     */
    public function scopeGetStatus(
        Builder $query,
        RequestStatusEnum $status
    ): void {
        $query->where('name', $status->value)->first();
    }
}
