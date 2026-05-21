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
}
