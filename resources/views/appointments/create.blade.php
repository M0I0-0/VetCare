<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('appointments.index') }}" class="text-teal-400 hover:text-teal-600 transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-extrabold text-2xl text-teal-800 leading-tight">
                📅 Nueva Cita
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-teal-100/60">

                <div class="mb-6">
                    <h3 class="text-lg font-extrabold text-teal-950">Programar Cita Veterinaria</h3>
                    <p class="text-xs text-gray-500 mt-1">Se enviará un correo electrónico de confirmación automático al propietario de la mascota con los detalles de la consulta.</p>
                </div>

                @if($errors->any())
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl mb-6">
                        <ul class="list-disc list-inside space-y-1 text-sm font-semibold">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Pet --}}
                        <div class="sm:col-span-2">
                            <label for="pet_id" class="block text-xs font-bold text-teal-700 uppercase tracking-wider mb-2">Mascota *</label>
                            <select id="pet_id" name="pet_id" required class="w-full rounded-2xl bg-[#fbfbf8]/40 border border-teal-100/80 text-teal-950 text-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all font-semibold @error('pet_id') border-rose-300 @enderror">
                                <option value="">Seleccionar mascota...</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                        🐾 {{ $pet->name }} — 👤 Dueño: {{ $pet->owner->name ?? 'Sin propietario' }} ({{ ucfirst($pet->species) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_id') <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        {{-- Veterinarian --}}
                        <div class="sm:col-span-2">
                            <label for="user_id" class="block text-xs font-bold text-teal-700 uppercase tracking-wider mb-2">Veterinario Asignado *</label>
                            <select id="user_id" name="user_id" required class="w-full rounded-2xl bg-[#fbfbf8]/40 border border-teal-100/80 text-teal-950 text-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all font-semibold @error('user_id') border-rose-300 @enderror">
                                <option value="">Seleccionar veterinario...</option>
                                @foreach($vets as $vet)
                                    <option value="{{ $vet->id }}" {{ old('user_id', auth()->id()) == $vet->id ? 'selected' : '' }}>
                                        🥼 {{ $vet->name }} ({{ ucfirst($vet->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        {{-- Scheduled At --}}
                        <div>
                            <label for="scheduled_at" class="block text-xs font-bold text-teal-700 uppercase tracking-wider mb-2">Fecha y Hora *</label>
                            <input type="datetime-local" id="scheduled_at" name="scheduled_at"
                                value="{{ old('scheduled_at') }}"
                                min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                                required
                                class="w-full rounded-2xl bg-[#fbfbf8]/40 border border-teal-100/80 text-teal-950 text-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all font-semibold @error('scheduled_at') border-rose-300 @enderror">
                            @error('scheduled_at') <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        {{-- Reason --}}
                        <div>
                            <label for="reason" class="block text-xs font-bold text-teal-700 uppercase tracking-wider mb-2">Motivo *</label>
                            <select id="reason" name="reason" required class="w-full rounded-2xl bg-[#fbfbf8]/40 border border-teal-100/80 text-teal-950 text-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all font-semibold @error('reason') border-rose-300 @enderror">
                                <option value="">Seleccionar motivo...</option>
                                @foreach($reasons as $key => $label)
                                    <option value="{{ $key }}" {{ old('reason') === $key ? 'selected' : '' }}>📋 {{ $label }}</option>
                                @endforeach
                            </select>
                            @error('reason') <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-xs font-bold text-teal-700 uppercase tracking-wider mb-2">Notas Adicionales (opcional)</label>
                            <textarea id="notes" name="notes" rows="3"
                                placeholder="Instrucciones especiales, síntomas previos observados por el propietario, medicamentos actuales..."
                                class="w-full rounded-2xl bg-[#fbfbf8]/40 border border-teal-100/80 text-teal-950 text-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all resize-none font-semibold @error('notes') border-rose-300 @enderror">{{ old('notes') }}</textarea>
                            @error('notes') <p class="text-rose-500 text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-5 border-t border-teal-50">
                        <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-4 py-2 border border-teal-200 text-teal-600 font-bold text-sm rounded-2xl hover:bg-teal-50 transition-all shadow-sm">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-bold text-sm rounded-2xl hover:shadow-lg hover:shadow-teal-500/20 transform hover:-translate-y-0.5 transition-all duration-150 shadow-sm">
                            <svg class="w-4.5 h-4.5 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Confirmar Cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

