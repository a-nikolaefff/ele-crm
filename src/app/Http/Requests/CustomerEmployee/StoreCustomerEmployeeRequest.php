<?php

namespace App\Http\Requests\CustomerEmployee;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerEmployeeRequest extends FormRequest
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
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'name' => ['required', 'string', 'max:70'],
            'post' => ['nullable', 'string', 'max:70'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'phone'],
        ];
    }
}
