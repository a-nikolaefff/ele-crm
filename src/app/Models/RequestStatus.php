<?php

namespace App\Models;

use App\Enums\RequestStatusEnum;
use App\Enums\UserRoleEnum;
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

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'status_id');
    }

    public function scopeGetStatus(Builder $query, RequestStatusEnum $status): void
    {
        $query->where('name', $status->value)->first();
    }
}
