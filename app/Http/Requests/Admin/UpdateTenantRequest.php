<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTenantRequest extends FormRequest
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
        $houseOwner = $this->route('tenant');
        $houseOwnerId = $houseOwner?->id ?? null;
        $userId = $houseOwner?->user_id ?? null;
        return [
            'name'          => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('house_owners', 'email')->ignore($houseOwnerId),
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'contact'       => ['required', 'string', 'max:15', 'regex:/^[0-9+\- ]+$/'],
            'building_id'   => 'required|exists:buildings,id',
            'flat_id'       => 'required|exists:flats,id',
        ];
    }

    /**
     * Custom error messages for validation
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'building_id.required'    => 'Please select a building.',
            'building_id.exists'      => 'Selected building does not exist.',

            'flat_id.required'        => 'Please select a flat.',
            'flat_id.exists'          => 'Selected flat does not exist.',
        ];
    }
}
