<?php

namespace App\Rules;

use App\Helpers\DateHelper;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class NotBeforeReceivedDate implements DataAwareRule, ValidationRule
{

    /**
     * date of receipt of the request
     *
     * @var Carbon
     */
    protected Carbon $receivedDate;

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->receivedDate = DateHelper::createFromString($data['received_at']);
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $date = DateHelper::createFromString($value);
        if ($date->lessThan($this->receivedDate)) {
            $fail(__('validation.custom.not-before-received-date'));
        }
    }
}
