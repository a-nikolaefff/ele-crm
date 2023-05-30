<?php

namespace App\Http\Requests\CustomerGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexCustomerTypeRequest extends FormRequest
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
        $sortableColumns = [
            'name',
            'created_at',
        ];

        return [
            'sort' => ['nullable', Rule::in($sortableColumns)],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
        ];
    }
}
