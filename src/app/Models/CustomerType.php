<?php

namespace App\Models;

use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CustomerType extends Model
{
    use Sortable;

    protected $table = 'customer_types';

    protected $fillable = ['name'];
}
