<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillRequest extends FormRequest
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
            'flat_id'          => ['required', 'exists:flats,id'],
            'bill_category_id' => ['required', 'exists:bill_categories,id'],
            'month'            => ['required', 'string', 'max:255'],
            'amount'           => ['required', 'numeric', 'min:0'],
            'notes'             => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'flat_id.required'          => 'Please select a flat.',
            'flat_id.exists'            => 'The selected flat does not exist.',
            'bill_category_id.required' => 'Please select a bill category.',
            'bill_category_id.exists'   => 'The selected bill category does not exist.',
        ];
    }
}
