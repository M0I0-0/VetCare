<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-purple-950 leading-tight flex items-center gap-2">
                <svg class="h-6 w-6 text-purple-600 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>{{ __('Nueva Receta y Consulta Médica') }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.2rem] shadow-3xs border border-[#e2d8f7] overflow-hidden">
                <div class="p-6 border-b border-[#e2d8f7] bg-purple-50/10 flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center shadow-3xs">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-purple-950 text-base">Crear Receta y Diagnóstico</h3>
                        <p class="text-xs text-gray-500 font-semibold mt-0.5">Selecciona el paciente con su dueño para registrar el diagnóstico y tratamiento.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('prescriptions.store') }}" class="p-8 space-y-6">
                    @csrf

                    <!-- Select Pet / Owner -->
                    <div>
                        <label for="pet_id" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Seleccionar Mascota (Paciente)</label>
                        <select id="pet_id" name="pet_id" required
                            class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs">
                            <option value="" disabled selected>Selecciona un paciente de la lista...</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                    🐾 {{ $pet->name }} ({{ ucfirst($pet->species) }}) — Propietario: {{ $pet->owner ? $pet->owner->name : 'Sin Dueño' }}
                                </option>
                            @endforeach
                        </select>
                        @error('pet_id')
                            <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Weight at Visit -->
                    <div>
                        <label for="weight_at_visit" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Peso en la consulta (kg)</label>
                        <input id="weight_at_visit" type="number" step="0.01" name="weight_at_visit" value="{{ old('weight_at_visit') }}" required placeholder="Ej. 12.50"
                            class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs" />
                        @error('weight_at_visit')
                            <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Diagnosis -->
                    <div>
                        <label for="diagnosis" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Diagnóstico y Notas Médicas</label>
                        <textarea id="diagnosis" name="diagnosis" rows="4" required placeholder="Describe las observaciones clínicas y diagnóstico..."
                            class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs">{{ old('diagnosis') }}</textarea>
                        @error('diagnosis')
                            <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Treatment / Prescription -->
                    <div>
                        <label for="treatment" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Tratamiento y Receta (Medicamentos)</label>
                        <textarea id="treatment" name="treatment" rows="4" required placeholder="Ej. Amoxicilina 250mg c/12h por 7 días..."
                            class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs">{{ old('treatment') }}</textarea>
                        @error('treatment')
                            <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="pt-6 border-t border-purple-50/50 flex justify-end gap-3">
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-2.5 bg-purple-50 border border-purple-200/50 hover:bg-purple-100 text-purple-700 font-bold text-sm rounded-2xl transition-all shadow-3xs">
                            Volver
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 hover:shadow-lg hover:shadow-purple-500/20 text-white font-bold text-sm rounded-2xl transform hover:-translate-y-0.5 transition-all duration-150">
                            Registrar Receta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
