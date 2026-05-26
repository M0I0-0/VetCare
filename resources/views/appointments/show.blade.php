<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-purple-950 leading-tight flex items-center gap-2">
                <a href="{{ route('appointments.index') }}" class="text-purple-500 hover:text-purple-700 transition-colors flex items-center">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                Cita #{{ str_pad($appointment->id, 4, '0', STR_PAD_LEFT) }}
            </h2>
            @if(Auth::user()->role !== 'recepcionista')
                <div class="flex gap-3">
                    <a href="{{ route('appointments.edit', $appointment) }}" class="inline-flex items-center gap-1.5 px-4 py-2 border border-purple-200 bg-purple-50 text-purple-700 font-bold text-sm rounded-2xl hover:bg-purple-100 transition-all shadow-sm">
                        <svg class="w-4 h-4 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Editar Cita
                    </a>
                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta cita permanentemente?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-rose-200 bg-rose-50 text-rose-600 font-bold text-sm rounded-2xl hover:bg-rose-100 transition-all shadow-sm">
                            <svg class="w-4 h-4 shrink-0 stroke-[2.2] me-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('message'))
                <div class="p-4 bg-purple-50 border border-purple-200 text-purple-700 rounded-2xl flex items-center gap-3 shadow-sm">
                    <svg class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold">{{ session('message') }}</span>
                </div>
            @endif

            @php
                $statusColors = [
                    'pendiente'  => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200/60'],
                    'confirmada' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-700', 'border' => 'border-indigo-200/60'],
                    'completada' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-700', 'border' => 'border-purple-200/60'],
                    'cancelada'  => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-200/60'],
                ];
                $sc = $statusColors[$appointment->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'border' => 'border-gray-200'];
            @endphp

            {{-- Main appointment card --}}
            <div class="bg-white border border-[#e2d8f7] shadow-3xs rounded-[2rem] p-8 overflow-hidden">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-6">
                    <div class="space-y-1">
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 rounded-2xl bg-purple-50 text-purple-650 flex items-center justify-center border border-purple-100 shrink-0">
                                <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-extrabold text-purple-950">
                                    {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('d/m/Y') }}
                                </h3>
                                <p class="text-xs text-purple-700/60 font-bold mt-1">
                                    <svg class="h-3.5 w-3.5 text-purple-400 shrink-0 inline-block align-middle me-1 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('H:i') }} hrs · Motivo: {{ \App\Models\Appointment::$reasons[$appointment->reason] ?? $appointment->reason }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-4.5 py-1.5 rounded-full text-xs font-extrabold border {{ $sc['bg'] }} {{ $sc['text'] }} {{ $sc['border'] }}">
                        {{ \App\Models\Appointment::$statuses[$appointment->status] ?? $appointment->status }}
                    </span>
                </div>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 border-t border-[#e2d8f7]/50">
                    {{-- Pet --}}
                    <div class="bg-purple-50/30 p-4 rounded-2xl border border-[#e2d8f7]/40">
                        <span class="text-xs text-purple-700/70 font-extrabold uppercase tracking-wider block mb-2">Mascota</span>
                        <a href="{{ route('pets.show', $appointment->pet) }}" class="font-extrabold text-purple-700 hover:text-purple-900 transition-colors text-base flex items-center gap-1.5 hover:underline">
                            <div class="h-6 w-6 rounded-full overflow-hidden bg-purple-50 border border-[#e2d8f7] shrink-0">
                                @if($appointment->pet->photo)
                                    <img src="{{ asset('storage/' . $appointment->pet->photo) }}" class="h-full w-full object-cover" alt="Foto">
                                @else
                                    <img src="{{ asset('images/logos/logo_vetcare.jpg') }}" class="h-full w-full object-cover opacity-80" alt="Logo">
                                @endif
                            </div>
                            {{ $appointment->pet->name }}
                        </a>
                        <p class="text-xs text-gray-500 mt-1 capitalize font-semibold flex items-center gap-1">
                            <svg class="h-3.5 w-3.5 text-purple-400 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                            {{ $appointment->pet->species }} · {{ $appointment->pet->breed }}
                        </p>
                    </div>
                    {{-- Vet --}}
                    <div class="bg-purple-50/30 p-4 rounded-2xl border border-[#e2d8f7]/40">
                        <span class="text-xs text-purple-700/70 font-extrabold uppercase tracking-wider block mb-2">Veterinario</span>
                        <p class="font-extrabold text-purple-900 text-base flex items-center gap-1.5">
                            <svg class="h-5 w-5 text-indigo-500 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            {{ $appointment->veterinarian->name }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1 capitalize font-semibold">Rol: {{ $appointment->veterinarian->role }}</p>
                    </div>
                    {{-- Owner --}}
                    <div class="bg-purple-50/30 p-4 rounded-2xl border border-[#e2d8f7]/40">
                        <span class="text-xs text-purple-700/70 font-extrabold uppercase tracking-wider block mb-2">Propietario</span>
                        @if($appointment->pet->owner)
                            <a href="{{ route('owners.show', $appointment->pet->owner) }}" class="font-extrabold text-purple-700 hover:text-purple-900 transition-colors text-base flex items-center gap-1.5 hover:underline">
                                <svg class="h-5 w-5 text-purple-550 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $appointment->pet->owner->name }}
                            </a>
                            <p class="text-xs text-gray-500 mt-1 font-semibold flex items-center gap-1.5">
                                <svg class="h-3.5 w-3.5 text-purple-400 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 00.908.717l1.5 1.5a1 1 0 001.09-.217l1.09-1.09a1 1 0 00-.717-.908l-2.2-.548A1 1 0 009 6.28V3a2 2 0 00-2-2H5a2 2 0 00-2 2v3a16 16 0 0016 16h3a2 2 0 002-2v-3.28a1 1 0 00-.725-.94l-2.2-.548a1 1 0 00-.717.908l-1.09 1.09a1 1 0 00-.217-1.09l-1.5-1.5z" />
                                </svg>
                                {{ $appointment->pet->owner->phone }}
                            </p>
                        @else
                            <span class="text-gray-400 text-sm font-semibold flex items-center gap-1.5">
                                <svg class="h-5 w-5 text-gray-300 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Sin propietario
                            </span>
                        @endif
                    </div>
                </div>

                @if($appointment->notes)
                    <div class="mt-6 p-5 bg-amber-50/40 border border-amber-200/50 rounded-2xl">
                        <span class="text-xs font-bold text-amber-700 uppercase tracking-wider flex items-center gap-1 mb-2">
                            <svg class="h-4 w-4 text-amber-600 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Notas Adicionales
                        </span>
                        <p class="text-sm text-gray-700 leading-relaxed font-semibold">{{ $appointment->notes }}</p>
                    </div>
                @endif

                <div class="mt-8 pt-5 border-t border-[#e2d8f7]/50 flex flex-wrap items-center justify-between gap-4 text-xs font-semibold text-gray-500">
                    <div class="flex items-center gap-3">
                        <span>Recordatorio por correo:</span>
                        @if($appointment->reminder_sent)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-100">Enviado</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-100">Pendiente</span>
                        @endif
                    </div>
                    <span class="text-gray-400">Creada {{ \Carbon\Carbon::parse($appointment->created_at)->diffForHumans() }}</span>
                </div>
            </div>

            {{-- Notification logs --}}
            @if($appointment->notificationLogs->count() > 0)
                <div class="bg-white border border-[#e2d8f7] shadow-3xs rounded-[2rem] p-8 overflow-hidden">
                    <h4 class="font-extrabold text-purple-950 text-lg mb-5 flex items-center gap-2">
                        <span class="h-8 w-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center border border-purple-100 shrink-0">
                            <svg class="h-5 w-5 text-purple-650" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        Historial de Notificaciones Enviadas
                    </h4>
                    <div class="space-y-3">
                        @foreach($appointment->notificationLogs as $log)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-2xl bg-purple-50/20 border border-[#e2d8f7]/40 gap-2">
                                <div class="flex items-center gap-3 flex-wrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-extrabold border
                                        {{ $log->status === 'sent' ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-rose-50 text-rose-700 border-rose-100' }}">
                                        {{ $log->status === 'sent' ? 'Enviado' : 'Fallido' }}
                                    </span>
                                    <span class="font-extrabold text-purple-900 capitalize text-sm">{{ $log->type }}</span>
                                    <span class="text-gray-500 font-semibold">→ {{ $log->recipient_email }}</span>
                                </div>
                                <span class="text-xs text-gray-400 font-bold">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
