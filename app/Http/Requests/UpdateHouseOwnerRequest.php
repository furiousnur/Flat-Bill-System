<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHouseOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('super-admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $houseOwner = $this->route('house_owner');
        $houseOwnerId = $houseOwner?->id ?? null;
        $userId = $houseOwner?->user_id ?? null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:15', 'regex:/^[0-9+\- ]+$/'],
            'email' => [
                'required',
                'email',
                Rule::unique('house_owners', 'email')->ignore($houseOwnerId),
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
