<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlternativeValueRequest extends FormRequest
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
            'alternative_id' => ['required', 'exists:alternatives,id'],
            'criteria_id' => ['required', 'exists:criteria,id'],
            'value' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:255'],
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
            'alternative_id.required' => 'Alternative must be selected.',
            'alternative_id.exists' => 'Selected alternative is invalid.',
            'criteria_id.required' => 'Criteria must be selected.',
            'criteria_id.exists' => 'Selected criteria is invalid.',
            'value.required' => 'Value is required.',
            'value.numeric' => 'Value must be a number.',
            'value.min' => 'Value must be 0 or greater.',
            'notes.string' => 'Notes must be text.',
            'notes.max' => 'Notes must not exceed 255 characters.',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $alternativeId = $this->input('alternative_id');
            $criteriaId = $this->input('criteria_id');
            $alternativeValueId = $this->route('alternativeValue')->id;

            if ($alternativeId && $criteriaId) {
                $exists = \App\Models\AlternativeValue::where('alternative_id', $alternativeId)
                    ->where('criteria_id', $criteriaId)
                    ->where('id', '!=', $alternativeValueId)
                    ->exists();

                if ($exists) {
                    $validator->errors()->add('criteria_id', 'This alternative already has a value for the selected criteria.');
                }
            }
        });
    }
}