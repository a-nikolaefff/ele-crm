<?php

namespace app\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'full_name' => ['required', 'string', 'max:70'],
            'customer_type_id' => [
                'nullable',
                'integer',
            ],
            'has_project_department' => ['nullable'],
            'website' => ['nullable', 'url'],
        ];
    }
}

