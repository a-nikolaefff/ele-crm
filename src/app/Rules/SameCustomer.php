<?php

namespace App\Rules;

use App\Models\CustomerEmployee;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class SameCustomer implements DataAwareRule, ValidationRule
{
    protected string $key;

    /**
     * id of the customer in the http request
     *
     * @var int
     */
    protected int $customerId;

    /**
     * @param int $customerId
     */

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $employee = CustomerEmployee::with('customer')->find($value);
        $employeeCustomerId = $employee->customer->id;
        if ($employeeCustomerId !== $this->customerId) {
            $fail(__('validation.custom.not-same-customer'));
        }
    }

    public function setData(array $data)
    {
        $this->customerId = (int) $data[$this->key];
    }
}
