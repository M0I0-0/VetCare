<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Requests\StoreMedicalRecordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MedicalRecordController extends Controller
{
    /**
     * Show the form for creating a new medical record.
     */
    public function create(Pet $pet): View
    {
        return view('medical_records.create', compact('pet'));
    }

    /**
     * Store a newly created medical record in storage.
     */
    public function store(StoreMedicalRecordRequest $request, Pet $pet): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $pet->medicalRecords()->create($validated);

        // Update the pet's current weight in its profile to reflect the latest checkup
        $pet->update(['weight' => $validated['weight_at_visit']]);

        return redirect()->route('pets.show', $pet)
            ->with('status', 'success')
            ->with('message', 'La consulta médica ha sido registrada exitosamente y se actualizó el peso de la mascota.');
    }

    /**
     * Show the form for creating a new general medical record (prescription).
     */
    public function createGeneral(): View
    {
        $pets = Pet::with('owner')->orderBy('name')->get();
        return view('medical_records.create_general', compact('pets'));
    }

    /**
     * Store a newly created general medical record (prescription) in storage.
     */
    public function storeGeneral(\Illuminate\Http\Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pet_id' => ['required', 'exists:pets,id'],
            'weight_at_visit' => ['required', 'numeric', 'min:0.01', 'max:999.99'],
            'diagnosis' => ['required', 'string', 'min:5'],
            'treatment' => ['required', 'string', 'min:5'],
        ], [
            'pet_id.required' => 'La mascota es obligatoria.',
            'pet_id.exists' => 'La mascota seleccionada no es válida.',
            'weight_at_visit.required' => 'El peso en la visita es obligatorio.',
            'weight_at_visit.numeric' => 'El peso debe ser un valor numérico.',
            'weight_at_visit.min' => 'El peso debe ser de al menos 0.01 kg.',
            'weight_at_visit.max' => 'El peso es demasiado alto.',
            'diagnosis.required' => 'El diagnóstico es obligatorio.',
            'diagnosis.min' => 'El diagnóstico debe tener al menos 5 caracteres.',
            'treatment.required' => 'El tratamiento/receta es obligatorio.',
            'treatment.min' => 'El tratamiento debe tener al menos 5 caracteres.',
        ]);

        $pet = Pet::findOrFail($validated['pet_id']);
        $validated['user_id'] = auth()->id();

        $pet->medicalRecords()->create($validated);

        // Update the pet's current weight
        $pet->update(['weight' => $validated['weight_at_visit']]);

        return redirect()->route('pets.show', $pet)
            ->with('status', 'success')
            ->with('message', 'La consulta médica y receta han sido registradas exitosamente y se actualizó el peso de la mascota.');
    }
}
