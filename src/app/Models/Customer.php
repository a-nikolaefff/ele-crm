<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Propaganistas\LaravelPhone\Casts\RawPhoneNumberCast;

class Customer extends Model
{
    use HasFactory, Filterable, Sortable;

    /**
     * The name of the table in the database
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'name',
            'full_name',
            'website',
            'customer_type_id',
            'has_project_department',
            'created_by_user_id',
            'updated_by_user_id',
        ];

    /**
     * Get the type of the customer.
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id');
    }

    /**
     * Get the employee who work for the customer.
     *
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(CustomerEmployee::class, 'customer_id');
    }

    /**
     * Get the requests of the customer.
     *
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'customer_id');
    }

    /**
     * Get the user who created the customer.
     *
     * @return BelongsTo
     */
    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * Get the user who updated the customer.
     *
     * @return BelongsTo
     */
    public function updatedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }
}
