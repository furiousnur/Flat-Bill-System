<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('house-owner');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bill_id'        => 'required|exists:bills,id',
            'amount'         => 'required|numeric|min:0.01',
            'payment_method' => 'nullable|string|max:255',
            'paid_at'        => 'nullable|date',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'bill_id.required'   => 'Please select a bill.',
            'bill_id.exists'     => 'Selected bill does not exist.',
            'amount.required'    => 'Please enter the payment amount.',
            'amount.numeric'     => 'Amount must be a number.',
            'amount.min'         => 'Amount must be at least 0.01.',
            'payment_method.string' => 'Payment method must be a valid text.',
            'paid_at.date'       => 'Paid at must be a valid date.',
        ];
    }
}
