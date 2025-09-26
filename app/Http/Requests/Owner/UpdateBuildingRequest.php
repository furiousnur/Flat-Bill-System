<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBuildingRequest extends FormRequest
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
        $buildingId = $this->route('building')->id ?? null;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('buildings', 'name')->ignore($buildingId),
            ],
            'address' => ['required', 'string', 'max:255'],
        ];
    }
}
