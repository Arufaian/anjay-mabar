<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlternativeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:150'],
            'type' => ['required', 'string', 'in:matic,maxi series,classy,sport,offroad,moped'],
            'model' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:'.(date('Y') + 1)],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Alternative name is required.',
            'name.max' => 'Alternative name must not exceed 150 characters.',
            'type.required' => 'Alternative type is required.',
            'type.in' => 'Selected type is invalid.',
            'model.max' => 'Model name must not exceed 255 characters.',
            'year.integer' => 'Year must be a valid number.',
            'year.digits' => 'Year must be exactly 4 digits.',
            'year.min' => 'Year must be 1900 or later.',
            'year.max' => 'Year cannot be more than '.(date('Y') + 1).'.',
            'description.max' => 'Description must not exceed 255 characters.',
        ];
    }
}
