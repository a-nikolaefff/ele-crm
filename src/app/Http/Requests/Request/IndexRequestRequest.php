<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequestRequest extends FormRequest
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
            'number',
            'received_at',
            'customer',
            'object',
            'equipment',
            'status_id',
            'prospect',
        ];

        return [
            'status_id' => [
                'nullable',
                'integer',
                'exists:request_statuses,id'
            ],
            'search' => ['nullable', 'string'],
            'sort' => ['nullable', Rule::in($sortableColumns)],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
        ];
    }
}
