<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-purple-950 leading-tight flex items-center gap-2">
                <a href="{{ route('pets.index') }}" class="text-purple-400 hover:text-purple-600 transition-colors mr-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <svg class="h-6 w-6 text-purple-650 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <span>{{ __('Papelera de Mascotas (Archivadas)') }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="p-4 bg-purple-50 border border-purple-200 text-purple-700 rounded-2xl flex items-center gap-3 shadow-sm">
                    <svg class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-3xs border border-[#e2d8f7] overflow-hidden">
                <div class="p-6 border-b border-[#e2d8f7] flex justify-between items-center bg-purple-50/10">
                    <h3 class="text-sm font-bold text-purple-950 uppercase tracking-wider">Mascotas archivadas temporalmente</h3>
                    <span class="px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200/50">
                        Papelera: {{ $pets->total() }}
                    </span>
                </div>

                @if($pets->isEmpty())
                    <div class="text-center py-16">
                        <div class="h-16 w-16 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 mx-auto mb-4 border border-[#e2d8f7] shadow-3xs">
                            <svg class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <h4 class="font-extrabold text-purple-950">La papelera está vacía</h4>
                        <p class="text-xs text-gray-500 mt-1 font-semibold">No hay mascotas archivadas en el sistema.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-purple-50/20 text-purple-950 text-xs font-extrabold uppercase border-b border-[#e2d8f7]">
                                    <th class="py-4 px-6">Foto</th>
                                    <th class="py-4 px-6">Nombre</th>
                                    <th class="py-4 px-6">Especie / Raza</th>
                                    <th class="py-4 px-6">Dueño</th>
                                    <th class="py-4 px-6">Detalles</th>
                                    <th class="py-4 px-6 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-100/50 text-sm">
                                @foreach($pets as $pet)
                                    <tr class="hover:bg-purple-50/20 transition-colors">
                                        <td class="py-4 px-6">
                                            @if($pet->photo)
                                                <img src="{{ asset('storage/' . $pet->photo) }}" class="h-10 w-10 rounded-xl object-cover border border-[#e2d8f7] shadow-sm grayscale" alt="{{ $pet->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded-xl overflow-hidden bg-purple-50 border border-[#e2d8f7] shadow-3xs flex items-center justify-center shrink-0">
                                                    <img src="{{ asset('images/logos/logo_vetcare.jpg') }}" class="h-full w-full object-cover opacity-60" alt="Logo">
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 font-extrabold text-purple-950 text-base">
                                            {{ $pet->name }}
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-2xs font-extrabold bg-purple-50 text-purple-700 border border-[#e2d8f7] capitalize self-start">
                                                    {{ $pet->species }}
                                                </span>
                                                <span class="text-xs text-gray-500 mt-1 font-semibold flex items-center gap-1">
                                                    <svg class="h-3.5 w-3.5 text-purple-400 shrink-0 stroke-[2.2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V9a2 2 0 00-2-2h-1M9 21h6" />
                                                    </svg>
                                                    {{ $pet->breed }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 font-semibold">
                                            @if($pet->owner)
                                                {{ $pet->owner->name }}
                                            @else
                                                <span class="text-rose-500 font-bold">Sin Dueño</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <div class="flex flex-col text-xs">
                                                <span class="text-purple-950 font-bold flex items-center gap-1">
                                                    <svg class="h-3.5 w-3.5 text-purple-550 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                                    </svg>
                                                    {{ $pet->weight }} kg
                                                </span>
                                                <span class="text-gray-500 font-semibold text-2xs mt-1 flex items-center gap-1">
                                                    <svg class="h-3.5 w-3.5 text-purple-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($pet->birthdate)->age }} años de edad
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'recepcionista')
                                                <!-- Restore Button -->
                                                <form action="{{ route('pets.restore', $pet->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200/50 text-xs font-extrabold rounded-xl transition-colors shadow-3xs" title="Restaurar Mascota">
                                                        <svg class="w-4 h-4 me-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 6.09" />
                                                        </svg>
                                                        Restaurar
                                                    </button>
                                                </form>

                                                <!-- Force Delete Button -->
                                                <form action="{{ route('pets.force-delete', $pet->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar PERMANENTEMENTE a esta mascota? Esta acción no se puede deshacer.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-violet-50 hover:bg-violet-100 text-violet-700 border border-violet-200/50 text-xs font-extrabold rounded-xl transition-colors shadow-3xs" title="Eliminar Permanente">
                                                        <svg class="w-4 h-4 me-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-400 italic">Sin permisos</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-[#e2d8f7]">
                        {{ $pets->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
