<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Requests\StoreVaccinationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VaccinationController extends Controller
{
    /**
     * Show the form for registering a new vaccination.
     */
    public function create(Pet $pet): View
    {
        return view('vaccinations.create', compact('pet'));
    }

    /**
     * Store a newly registered vaccination in storage.
     */
    public function store(StoreVaccinationRequest $request, Pet $pet): RedirectResponse
    {
        $validated = $request->validated();

        $pet->vaccinations()->create($validated);

        return redirect()->route('pets.show', $pet)
            ->with('status', 'success')
            ->with('message', 'La vacuna ha sido registrada exitosamente en la cartilla de inmunización.');
    }
}
