<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalRecordRequest extends FormRequest
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
            'weight_at_visit' => ['required', 'numeric', 'min:0.01', 'max:999.99'],
            'diagnosis' => ['required', 'string', 'min:5'],
            'treatment' => ['required', 'string', 'min:5'],
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
            'weight_at_visit.required' => 'El peso en la visita es obligatorio.',
            'weight_at_visit.numeric' => 'El peso debe ser un valor numérico.',
            'weight_at_visit.min' => 'El peso debe ser de al menos 0.01 kg.',
            'weight_at_visit.max' => 'El peso es demasiado alto.',
            'diagnosis.required' => 'El diagnóstico es obligatorio.',
            'diagnosis.min' => 'El diagnóstico debe tener al menos 5 caracteres.',
            'treatment.required' => 'El tratamiento/receta es obligatorio.',
            'treatment.min' => 'El tratamiento debe tener al menos 5 caracteres.',
        ];
    }
}
