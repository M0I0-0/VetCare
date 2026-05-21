<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccinationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'dose' => ['required', 'string', 'max:100'],
            'date_applied' => ['required', 'date', 'before_or_equal:today'],
            'next_dose_due' => ['nullable', 'date', 'after:date_applied'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la vacuna es obligatorio.',
            'name.max' => 'El nombre de la vacuna no puede superar los 255 caracteres.',
            'dose.required' => 'La dosis es obligatoria.',
            'dose.max' => 'La dosis no puede superar los 100 caracteres.',
            'date_applied.required' => 'La fecha de aplicación es obligatoria.',
            'date_applied.before_or_equal' => 'La fecha de aplicación no puede ser en el futuro.',
            'next_dose_due.after' => 'La fecha de la próxima dosis debe ser posterior a la fecha de aplicación.',
        ];
    }
}
