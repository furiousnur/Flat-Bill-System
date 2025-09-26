<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFlatRequest extends FormRequest
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
        $flatId = $this->route('flat')->id ?? null;
        return [
            'flat_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('flats', 'flat_number')->ignore($flatId),
            ],
            'building_id'         => ['required', 'exists:buildings,id'],
            'flat_owner_name'     => ['required', 'string', 'max:255'],
            'flat_owner_contact'  => ['required', 'string', 'max:15', 'regex:/^[0-9+\- ]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'building_id.required' => 'Please select a building.',
            'building_id.exists'   => 'The selected building does not exist.',
        ];
    }
}
