<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight flex items-center gap-2">
            <a href="{{ route('pets.show', $pet) }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            {{ __('Registrar Nueva Consulta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Patient Mini Summary Card -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-3xl p-6 shadow-xl mb-6 flex items-center justify-between border border-slate-700/50">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-slate-800/80 border border-slate-700 flex items-center justify-center text-3xl shadow-inner">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-full object-cover rounded-2xl">
                        @else
                            @switch(strtolower($pet->species))
                                @case('perro') 🐕 @break
                                @case('gato') 🐈 @break
                                @case('conejo') 🐇 @break
                                @case('ave') 🦜 @break
                                @default 🐾
                            @endswitch
                        @endif
                    </div>
                    <div>
                        <span class="text-xs text-emerald-400 font-bold uppercase tracking-wider">Paciente en Consulta</span>
                        <h3 class="text-xl font-bold font-outfit">{{ $pet->name }}</h3>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ ucfirst($pet->species) }} ({{ $pet->breed }}) &bull; Dueño: <span class="font-semibold text-slate-300">{{ $pet->owner->name }}</span>
                        </p>
                    </div>
                </div>
                <div class="text-right hidden sm:block">
                    <span class="text-xs text-slate-400 block">Peso Actual</span>
                    <span class="text-2xl font-black text-emerald-400 font-outfit">{{ number_format($pet->weight, 2) }} kg</span>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-800/50 overflow-hidden">
                <div class="p-8 border-b border-gray-100 dark:border-gray-800/50 bg-gray-50/50 dark:bg-gray-950/20">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Datos de la Consulta Médica</h3>
                    <p class="text-xs text-gray-500 mt-1">Completa los detalles clínicos, diagnóstico y el tratamiento/receta para el paciente.</p>
                </div>

                <form action="{{ route('pets.medical-records.store', $pet) }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <!-- Weight at Visit -->
                    <div class="space-y-2">
                        <label for="weight_at_visit" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Peso en la Consulta (kg)</label>
                        <div class="relative rounded-xl shadow-sm">
                            <input type="number" step="0.01" min="0.01" max="999.99" name="weight_at_visit" id="weight_at_visit" value="{{ old('weight_at_visit', $pet->weight) }}" class="w-full px-4 py-3 rounded-xl border @error('weight_at_visit') border-rose-500 focus:ring-rose-500 focus:border-rose-500 @else border-gray-200 dark:border-gray-800 focus:ring-emerald-500 focus:border-emerald-500 @enderror bg-gray-50/50 dark:bg-gray-950/50 text-gray-800 dark:text-gray-100 placeholder-gray-400 transition-all focus:outline-none focus:ring-2" placeholder="Ej. 12.50" required>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400 font-semibold text-sm">
                                kg
                            </div>
                        </div>
                        @error('weight_at_visit')
                            <p class="text-xs text-rose-500 font-semibold mt-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Diagnosis -->
                    <div class="space-y-2">
                        <label for="diagnosis" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Diagnóstico</label>
                        <textarea name="diagnosis" id="diagnosis" rows="4" class="w-full px-4 py-3 rounded-xl border @error('diagnosis') border-rose-500 focus:ring-rose-500 focus:border-rose-500 @else border-gray-200 dark:border-gray-800 focus:ring-emerald-500 focus:border-emerald-500 @enderror bg-gray-50/50 dark:bg-gray-950/50 text-gray-800 dark:text-gray-100 placeholder-gray-400 transition-all focus:outline-none focus:ring-2" placeholder="Describe los síntomas observados y el diagnóstico médico..." required>{{ old('diagnosis') }}</textarea>
                        @error('diagnosis')
                            <p class="text-xs text-rose-500 font-semibold mt-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Treatment -->
                    <div class="space-y-2">
                        <label for="treatment" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Tratamiento y Receta</label>
                        <textarea name="treatment" id="treatment" rows="4" class="w-full px-4 py-3 rounded-xl border @error('treatment') border-rose-500 focus:ring-rose-500 focus:border-rose-500 @else border-gray-200 dark:border-gray-800 focus:ring-emerald-500 focus:border-emerald-500 @enderror bg-gray-50/50 dark:bg-gray-950/50 text-gray-800 dark:text-gray-100 placeholder-gray-400 transition-all focus:outline-none focus:ring-2" placeholder="Indica el tratamiento, medicamentos, dosis y frecuencia recomendada..." required>{{ old('treatment') }}</textarea>
                        @error('treatment')
                            <p class="text-xs text-rose-500 font-semibold mt-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-4 flex items-center justify-end gap-3">
                        <a href="{{ route('pets.show', $pet) }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors bg-gray-100 dark:bg-gray-850 hover:bg-gray-200/80 dark:hover:bg-gray-800">
                            Cancelar
                        </a>
                        <button type="submit" class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-500 shadow-md hover:shadow-lg hover:shadow-emerald-600/20 active:bg-emerald-700 transition-all">
                            Guardar Consulta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
