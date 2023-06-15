<?php

declare(strict_types=1);

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function createFromString($date): Carbon
    {
        return Carbon::createFromFormat('d.m.Y', $date);
    }
}
