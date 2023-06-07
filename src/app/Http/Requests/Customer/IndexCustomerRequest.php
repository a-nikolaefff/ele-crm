<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IndexCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $sortableColumns = [
            'name',
            'full_name',
            'customer_type_id',
        ];

        return [
            'customer_type_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'none'
                        && !Validator::make(
                            [$attribute => $value],
                            [$attribute => 'exists:customer_types,id']
                        )->passes()
                    ) {
                        $fail(__('validation.exists', [$attribute]));
                    }
                }
            ],
            'search' => ['nullable', 'string'],
            'sort' => ['nullable', Rule::in($sortableColumns)],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
        ];
    }
}
