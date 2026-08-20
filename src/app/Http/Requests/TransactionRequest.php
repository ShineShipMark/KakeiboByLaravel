<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'amount' => ['required', 'integer', 'min:1'],
            'date' => ['required', 'date'],
            'fromAccountId' => ['nullable', 'integer', 'exists:accounts,id'],
            'toAccountId' => ['nullable', 'integer', 'exists:accounts,id'],
            'categoryId' => ['nullable', 'integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'allocations' => ['nullable', 'array'],
            'allocations.*.categoryId' => ['required', 'integer'],
            'allocations.*.amount' => ['required', 'integer', 'min:1'],
        ];
    }
}
