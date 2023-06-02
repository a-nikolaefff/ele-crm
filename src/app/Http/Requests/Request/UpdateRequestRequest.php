<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestRequest extends FormRequest
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
            'answered_at' => ['date', 'nullable'],
            'customer_id' => ['integer', 'exists:customers,id'],
            'project_organization_id' => ['integer', 'exists:customers,id', 'nullable'],
            'object' => ['required', 'string', 'max:75'],
            'equipment' => ['required', 'string', 'max:100'],
            'comment' => ['nullable', 'string', 'max:200'],
            'status_id' => ['integer', 'exists:request_statuses,id'],
            'prospect' => 'required|integer|between:0,5',
        ];
    }
}
