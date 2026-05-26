<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-purple-950 leading-tight flex items-center gap-2.5">
                <svg class="h-7 w-7 text-purple-650 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ __('Agenda de Citas') }}</span>
            </h2>
            @if(Auth::user()->role !== 'recepcionista')
                <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 text-white font-bold text-sm rounded-2xl hover:shadow-lg hover:shadow-purple-500/20 transform hover:-translate-y-0.5 transition-all duration-150 shadow-sm">
                    <svg class="w-4 h-4 me-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Nueva Cita
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('message'))
                <div class="p-4 bg-purple-50 border border-purple-200 text-purple-700 rounded-2xl flex items-center gap-3 shadow-sm">
                    <svg class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold">{{ session('message') }}</span>
                </div>
            @endif

            {{-- Stats bar --}}
            @php
                $total     = $appointments->total();
                $pendiente = \App\Models\Appointment::where('status','pendiente')->count();
                $confirmada = \App\Models\Appointment::where('status','confirmada')->count();
                $hoy       = \App\Models\Appointment::whereDate('scheduled_at', today())->count();
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl p-5 border border-[#e2d8f7] shadow-3xs text-center">
                    <div class="text-3xl font-black text-purple-950">{{ $total }}</div>
                    <div class="text-xs text-purple-700 font-bold uppercase tracking-wider mt-1">Total Citas</div>
                </div>
                <div class="bg-amber-50/60 rounded-2xl p-5 border border-amber-200/50 shadow-3xs text-center">
                    <div class="text-3xl font-black text-amber-700">{{ $pendiente }}</div>
                    <div class="text-xs text-amber-600/70 font-bold uppercase tracking-wider mt-1">Pendientes</div>
                </div>
                <div class="bg-indigo-50/60 rounded-2xl p-5 border border-[#e2d8f7] shadow-3xs text-center">
                    <div class="text-3xl font-black text-indigo-700">{{ $confirmada }}</div>
                    <div class="text-xs text-indigo-600/70 font-bold uppercase tracking-wider mt-1">Confirmadas</div>
                </div>
                <div class="bg-purple-50/60 rounded-2xl p-5 border border-purple-200/50 shadow-3xs text-center">
                    <div class="text-3xl font-black text-purple-700">{{ $hoy }}</div>
                    <div class="text-xs text-purple-650 font-bold uppercase tracking-wider mt-1">Hoy</div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-3xs border border-[#e2d8f7] overflow-hidden">
                <div class="p-6 border-b border-[#e2d8f7] flex justify-between items-center bg-purple-50/10">
                    <h3 class="text-sm font-bold text-purple-955 uppercase tracking-wider">Citas programadas en la veterinaria</h3>
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-purple-50 text-purple-700 border border-[#e2d8f7]">
                        Página actual: {{ $appointments->count() }}
                    </span>
                </div>

                @if($appointments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-purple-50/20 text-purple-950 text-xs font-extrabold uppercase border-b border-[#e2d8f7]">
                                    <th class="py-4 px-6">Fecha / Hora</th>
                                    <th class="py-4 px-6">Mascota</th>
                                    <th class="py-4 px-6">Propietario</th>
                                    <th class="py-4 px-6">Veterinario</th>
                                    <th class="py-4 px-6">Motivo</th>
                                    <th class="py-4 px-6">Estado</th>
                                    <th class="py-4 px-6 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-100/50 text-sm">
                                @foreach($appointments as $appt)
                                    @php
                                        $statusColors = [
                                            'pendiente'  => 'bg-amber-50 text-amber-700 border-amber-100 shadow-3xs',
                                            'confirmada' => 'bg-indigo-50 text-indigo-700 border-[#e2d8f7] shadow-3xs',
                                            'completada' => 'bg-purple-50 text-purple-700 border-purple-100 shadow-3xs',
                                            'cancelada'  => 'bg-rose-50 text-rose-700 border-rose-100 shadow-3xs',
                                        ];
                                        $color = $statusColors[$appt->status] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                                        $isPast = $appt->scheduled_at->isPast();
                                    @endphp
                                    <tr class="hover:bg-purple-50/20 transition-colors {{ $isPast && $appt->status === 'pendiente' ? 'opacity-60' : '' }}">
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <div class="font-extrabold text-purple-950 text-sm flex items-center gap-1.5">
                                                <svg class="h-4 w-4 text-purple-550 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $appt->scheduled_at->format('d/m/Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500 font-semibold mt-1 flex items-center gap-1">
                                                <svg class="h-3.5 w-3.5 text-purple-400 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $appt->scheduled_at->format('H:i') }} hrs
                                            </div>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('pets.show', $appt->pet) }}" class="font-extrabold text-purple-600 hover:text-purple-800 hover:underline flex items-center gap-1.5 text-sm">
                                                <div class="h-8 w-8 rounded-full overflow-hidden bg-purple-50 border border-[#e2d8f7] shrink-0">
                                                    @if($appt->pet->photo)
                                                        <img src="{{ asset('storage/' . $appt->pet->photo) }}" class="h-full w-full object-cover" alt="Foto">
                                                    @else
                                                        <img src="{{ asset('images/logos/logo_vetcare.jpg') }}" class="h-full w-full object-cover opacity-80" alt="Logo">
                                                    @endif
                                                </div>
                                                {{ $appt->pet->name }}
                                            </a>
                                            <div class="text-xs text-gray-500 capitalize font-semibold mt-1 flex items-center gap-1">
                                                <svg class="h-3.5 w-3.5 text-purple-400 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                                </svg>
                                                {{ $appt->pet->species }}
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($appt->pet->owner)
                                                <a href="{{ route('owners.show', $appt->pet->owner) }}" class="text-purple-700 hover:text-purple-900 font-bold hover:underline text-xs flex items-center gap-1">
                                                    <svg class="h-3.5 w-3.5 text-purple-500 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    {{ $appt->pet->owner->name }}
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs font-semibold flex items-center gap-1">
                                                    <svg class="h-3.5 w-3.5 text-gray-300 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    Sin dueño
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-purple-950 font-bold text-xs flex items-center gap-1">
                                                <svg class="h-3.5 w-3.5 text-indigo-500 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                                {{ $appt->veterinarian->name }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-xs font-bold text-purple-700/80 flex items-center gap-1">
                                                <svg class="h-3.5 w-3.5 text-purple-400 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                {{ \App\Models\Appointment::$reasons[$appt->reason] ?? $appt->reason }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold border {{ $color }}">
                                                {{ \App\Models\Appointment::$statuses[$appt->status] ?? $appt->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                            <a href="{{ route('appointments.show', $appt) }}" class="inline-flex items-center px-3 py-1.5 bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-200/50 rounded-xl transition-all shadow-3xs text-xs font-bold gap-1" title="Ver Detalle">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span>Ver</span>
                                            </a>
                                            @if(Auth::user()->role !== 'recepcionista')
                                                <a href="{{ route('appointments.edit', $appt) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200/50 rounded-xl transition-all shadow-3xs text-xs font-bold gap-1" title="Editar">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <span>Editar</span>
                                                </a>
                                                <form action="{{ route('appointments.destroy', $appt) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta cita?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-violet-50 hover:bg-violet-100 text-violet-600 border border-violet-200/50 rounded-xl transition-all shadow-3xs text-xs font-bold gap-1" title="Eliminar">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        <span>Eliminar</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-[#e2d8f7]">
                        {{ $appointments->links() }}
                    </div>
                @else
                    <div class="py-20 text-center">
                        <div class="h-20 w-20 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center mx-auto shadow-inner mb-5 border border-[#e2d8f7]">
                            <svg class="h-10 w-10 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-extrabold text-purple-950 text-lg mb-2">Sin Citas Programadas</h3>
                        <p class="text-xs text-gray-500 mb-6 max-w-sm mx-auto font-semibold">No hay citas en el sistema todavía. ¡Crea la primera cita para comenzar a gestionar la agenda de la clínica!</p>
                        @if(Auth::user()->role !== 'recepcionista')
                            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 text-white font-bold text-sm rounded-2xl hover:shadow-lg hover:shadow-purple-500/20 transform hover:-translate-y-0.5 transition-all">
                                + Programar Primera Cita
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
