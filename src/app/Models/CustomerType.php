<?php

namespace App\Models;

use App\Enums\BaseCustomerTypeEnum;
use App\Enums\RequestStatusEnum;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerType extends Model
{
    use Sortable;

    /**
     * The name of the table in the database
     *
     * @var string
     */
    protected $table = 'customer_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'customer_type_id');
    }

    public function scopeGetBaseCustomerType(
        Builder $query,
        BaseCustomerTypeEnum $customerType
    ): void {
        $query->where('name', $customerType->value)->first();
    }
}
