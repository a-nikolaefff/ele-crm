<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestRequest extends FormRequest
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
            'received_at' => ['required', 'date'],
            'object' => ['required', 'string', 'max:200'],
            'equipment' => ['required', 'string', 'max:200'],
            'comment' => ['nullable', 'string', 'max:200'],
            'customer_id' => ['exists:customers,id'],
            'project_organization_id' => [
                'integer',
                'exists:customers,id',
                'nullable'
            ],
            'prospect' => 'required|integer|between:0,5',
            'expected_order_date' => ['date', 'nullable'],
        ];
    }
}

