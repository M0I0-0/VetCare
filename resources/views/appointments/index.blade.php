<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-teal-800 leading-tight flex items-center gap-2">
                📅 {{ __('Agenda de Citas') }}
            </h2>
            @if(Auth::user()->role !== 'recepcionista')
                <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-bold text-sm rounded-2xl hover:shadow-lg hover:shadow-teal-500/20 transform hover:-translate-y-0.5 transition-all duration-150 shadow-sm">
                    <svg class="w-4.5 h-4.5 me-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 shadow-sm">
                    <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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
                <div class="bg-white rounded-2xl p-5 border border-teal-100/50 shadow-sm text-center">
                    <div class="text-3xl font-black text-teal-800">{{ $total }}</div>
                    <div class="text-xs text-teal-600/70 font-bold uppercase tracking-wider mt-1">Total Citas</div>
                </div>
                <div class="bg-amber-50/60 rounded-2xl p-5 border border-amber-200/50 shadow-sm text-center">
                    <div class="text-3xl font-black text-amber-700">{{ $pendiente }}</div>
                    <div class="text-xs text-amber-600/70 font-bold uppercase tracking-wider mt-1">Pendientes</div>
                </div>
                <div class="bg-emerald-50/60 rounded-2xl p-5 border border-emerald-200/50 shadow-sm text-center">
                    <div class="text-3xl font-black text-emerald-700">{{ $confirmada }}</div>
                    <div class="text-xs text-emerald-600/70 font-bold uppercase tracking-wider mt-1">Confirmadas</div>
                </div>
                <div class="bg-orange-50/60 rounded-2xl p-5 border border-orange-200/50 shadow-sm text-center">
                    <div class="text-3xl font-black text-orange-700">{{ $hoy }}</div>
                    <div class="text-xs text-orange-600/70 font-bold uppercase tracking-wider mt-1">Hoy</div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-teal-100/60 overflow-hidden">
                <div class="p-6 border-b border-teal-50/50 flex justify-between items-center bg-teal-50/10">
                    <h3 class="text-sm font-bold text-teal-700 uppercase tracking-wider">Citas programadas en la veterinaria</h3>
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-teal-50 text-teal-700 border border-teal-100">
                        Página actual: {{ $appointments->count() }}
                    </span>
                </div>

                @if($appointments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-orange-50/30 text-teal-800 text-xs font-extrabold uppercase border-b border-teal-50">
                                    <th class="py-4 px-6">Fecha / Hora</th>
                                    <th class="py-4 px-6">Mascota</th>
                                    <th class="py-4 px-6">Propietario</th>
                                    <th class="py-4 px-6">Veterinario</th>
                                    <th class="py-4 px-6">Motivo</th>
                                    <th class="py-4 px-6">Estado</th>
                                    <th class="py-4 px-6 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-teal-50/30 text-sm">
                                @foreach($appointments as $appt)
                                    @php
                                        $statusColors = [
                                            'pendiente'  => 'bg-amber-50 text-amber-700 border-amber-100 shadow-3xs',
                                            'confirmada' => 'bg-emerald-50 text-emerald-700 border-emerald-100 shadow-3xs',
                                            'completada' => 'bg-teal-50 text-teal-700 border-teal-100 shadow-3xs',
                                            'cancelada'  => 'bg-rose-50 text-rose-700 border-rose-100 shadow-3xs',
                                        ];
                                        $color = $statusColors[$appt->status] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                                        $isPast = $appt->scheduled_at->isPast();
                                    @endphp
                                    <tr class="hover:bg-[#fbfbf8]/50 transition-colors {{ $isPast && $appt->status === 'pendiente' ? 'opacity-60' : '' }}">
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <div class="font-extrabold text-teal-950 text-sm flex items-center gap-1.5">
                                                📅 {{ $appt->scheduled_at->format('d/m/Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500 font-semibold mt-1">⏰ {{ $appt->scheduled_at->format('H:i') }} hrs</div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('pets.show', $appt->pet) }}" class="font-extrabold text-teal-600 hover:text-teal-800 hover:underline flex items-center gap-1.5 text-sm">
                                                @if(strtolower($appt->pet->species) === 'perro') 🐶
                                                @elseif(strtolower($appt->pet->species) === 'gato') 🐱
                                                @elseif(strtolower($appt->pet->species) === 'ave') 🦜
                                                @elseif(strtolower($appt->pet->species) === 'conejo') 🐰
                                                @else 🐾
                                                @endif
                                                {{ $appt->pet->name }}
                                            </a>
                                            <div class="text-xs text-gray-400 capitalize font-medium mt-1">🧬 {{ $appt->pet->species }}</div>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($appt->pet->owner)
                                                <a href="{{ route('owners.show', $appt->pet->owner) }}" class="text-teal-700 hover:text-teal-900 font-bold hover:underline text-xs flex items-center gap-1">
                                                    👤 {{ $appt->pet->owner->name }}
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs font-semibold">👤 Sin dueño</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-teal-900 font-bold text-xs flex items-center gap-1">
                                                🥼 {{ $appt->veterinarian->name }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-xs font-semibold text-gray-600">
                                                📋 {{ \App\Models\Appointment::$reasons[$appt->reason] ?? $appt->reason }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold border {{ $color }}">
                                                {{ \App\Models\Appointment::$statuses[$appt->status] ?? $appt->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right whitespace-nowrap">
                                            <a href="{{ route('appointments.show', $appt) }}" class="inline-flex items-center px-3 py-1 bg-teal-50 border border-teal-100 hover:bg-teal-100 text-teal-700 font-bold text-xs rounded-xl transition-all shadow-3xs me-2">Ver</a>
                                            @if(Auth::user()->role !== 'recepcionista')
                                                <a href="{{ route('appointments.edit', $appt) }}" class="inline-flex items-center px-3 py-1 bg-amber-50 border border-amber-100 hover:bg-amber-100 text-amber-700 font-bold text-xs rounded-xl transition-all shadow-3xs me-2">Editar</a>
                                                <form action="{{ route('appointments.destroy', $appt) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta cita?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-rose-50 border border-rose-100 hover:bg-rose-100 text-rose-700 font-bold text-xs rounded-xl transition-all shadow-3xs">Eliminar</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-teal-50 bg-teal-50/5">
                        {{ $appointments->links() }}
                    </div>
                @else
                    <div class="py-20 text-center">
                        <div class="h-20 w-20 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center text-4xl mx-auto shadow-inner mb-5 border border-orange-100">📅</div>
                        <h3 class="font-extrabold text-teal-800 text-lg mb-2">Sin Citas Programadas</h3>
                        <p class="text-xs text-gray-500 mb-6 max-w-sm mx-auto">No hay citas en el sistema todavía. ¡Crea la primera cita para comenzar a gestionar la agenda de la clínica!</p>
                        @if(Auth::user()->role !== 'recepcionista')
                            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-teal-400 to-emerald-500 text-white font-bold text-sm rounded-2xl hover:shadow-lg hover:shadow-teal-500/20 transform hover:-translate-y-0.5 transition-all">
                                + Programar Primera Cita
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

