<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Propaganistas\LaravelPhone\Casts\RawPhoneNumberCast;

class CustomerEmployee extends Model
{
    use HasFactory;

    /**
     * The name of the table in the database
     *
     * @var string
     */
    protected $table = 'customer_employees';

    protected $fillable
        = [
            'name',
            'post',
            'email',
            'phone',
            'customer_id',
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
     * Get the customer of the employee.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
