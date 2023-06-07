<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
            'contact_person',
            'email',
            'phone',
            'customer_type_id',
            'created_by_user_id',
            'updated_by_user_id',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    public $casts
        = [
            'phone' => RawPhoneNumberCast::class . ':RU',
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
