<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-purple-950 leading-tight flex items-center gap-2.5">
                <a href="{{ route('owners.index') }}" class="inline-flex items-center justify-center h-10 w-10 bg-purple-50/80 hover:bg-purple-50 text-purple-700 rounded-full transition-all border border-[#e2d8f7] shadow-2xs" title="Regresar al listado">
                    <svg class="h-5 w-5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ __('Perfil del Dueño') }}</span>
            </h2>
            <div class="flex gap-2.5">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('owners.edit', $owner) }}" class="inline-flex items-center px-4 py-2.5 bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-200/50 font-extrabold text-xs sm:text-sm rounded-2xl transition-all shadow-2xs hover:-translate-y-0.5">
                        <svg class="w-4 h-4 me-2 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Editar Datos
                    </a>
                @endif
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'recepcionista')
                    <a href="{{ route('pets.create', ['owner_id' => $owner->id]) }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 text-white font-extrabold text-xs sm:text-sm rounded-2xl transition-all shadow-md hover:shadow-lg hover:shadow-purple-500/20 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 me-2 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Asociar Mascota
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="p-4 bg-purple-50 border border-purple-200 text-purple-700 rounded-2xl flex items-center gap-3 shadow-2xs">
                    <svg class="h-5 w-5 text-purple-500 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-extrabold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Owner Card Info -->
            <div class="bg-white rounded-[2rem] p-6 sm:p-8 shadow-3xs border border-[#e2d8f7] flex flex-col md:flex-row gap-6 sm:gap-8 relative overflow-hidden">
                <div class="absolute -right-24 -bottom-24 w-80 h-80 bg-gradient-to-tr from-purple-500/5 to-indigo-500/5 rounded-full blur-3xl"></div>
                
                <!-- Avatar circle representing owner -->
                <div class="h-20 w-20 rounded-3xl bg-gradient-to-tr from-purple-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-black shadow-lg shadow-purple-500/25 self-start shrink-0">
                    {{ strtoupper(substr($owner->name, 0, 2)) }}
                </div>
                
                <div class="space-y-4 flex-1">
                    <div>
                        <h3 class="text-2xl font-extrabold text-purple-950 tracking-tight">{{ $owner->name }}</h3>
                        <p class="text-xs text-purple-700/60 font-bold uppercase tracking-wider mt-0.5">Cliente Distinguido VetCare</p>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-[#e2d8f7]">
                        <div class="space-y-0.5">
                            <span class="text-xs text-purple-750 font-bold uppercase tracking-wider block">Correo Electrónico</span>
                            <span class="text-sm font-extrabold text-purple-950 flex items-center gap-1.5 mt-1">
                                <svg class="h-4 w-4 text-purple-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $owner->email }}</span>
                            </span>
                        </div>
                        <div class="space-y-0.5">
                            <span class="text-xs text-purple-750 font-bold uppercase tracking-wider block">Teléfono de Contacto</span>
                            <span class="text-sm font-extrabold text-purple-950 flex items-center gap-1.5 mt-1">
                                <svg class="h-4 w-4 text-purple-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>{{ $owner->phone }}</span>
                            </span>
                        </div>
                        <div class="space-y-0.5">
                            <span class="text-xs text-purple-750 font-bold uppercase tracking-wider block">Dirección Postal</span>
                            <span class="text-sm font-extrabold text-purple-950 flex items-center gap-1.5 mt-1">
                                <svg class="h-4 w-4 text-purple-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $owner->address }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pets section -->
            <div class="space-y-4">
                <h3 class="text-lg font-extrabold text-purple-950 flex items-center gap-2">
                    <span class="h-3 w-3 rounded-full bg-purple-500 shadow-2xs animate-pulse"></span>
                    Mascotas Asociadas
                </h3>

                @if($owner->pets->isEmpty())
                    <div class="bg-white rounded-[2rem] p-12 shadow-3xs border border-[#e2d8f7] text-center">
                        <div class="h-16 w-16 rounded-full bg-purple-50 flex items-center justify-center mx-auto mb-4 border border-[#e2d8f7] p-1.5">
                            <img src="{{ asset('images/logos/logo_vetcare.jpg') }}" class="h-full w-full rounded-full object-cover" alt="VetCare Logo">
                        </div>
                        <h4 class="font-extrabold text-purple-950">Este dueño no tiene mascotas registradas</h4>
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'recepcionista')
                            <p class="text-xs text-gray-500 mt-1 mb-6 font-semibold">Asocia una mascota para gestionar sus consultas médicas y vacunas.</p>
                            <a href="{{ route('pets.create', ['owner_id' => $owner->id]) }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 text-white font-extrabold text-xs sm:text-sm rounded-2xl transition-all shadow-md hover:-translate-y-0.5">
                                Registrar Mascota
                            </a>
                        @endif
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($owner->pets as $pet)
                            <div class="bg-white rounded-[2rem] p-6 shadow-3xs border border-[#e2d8f7] hover:shadow-2xs hover:-translate-y-0.5 transition-all duration-300 flex flex-col justify-between">
                                <div class="space-y-4">
                                    <div class="flex items-center gap-4">
                                        <!-- Pet photo -->
                                        @if($pet->photo)
                                            <div class="bg-gradient-to-tr from-purple-200 to-indigo-300 p-0.5 rounded-[1.2rem] shadow-3xs">
                                                <img src="{{ asset('storage/' . $pet->photo) }}" class="h-14 w-14 rounded-[1.1rem] object-cover border-2 border-white shadow-2xs" alt="{{ $pet->name }}">
                                            </div>
                                        @else
                                            <div class="h-14 w-14 rounded-2xl bg-purple-50 border border-[#e2d8f7] flex items-center justify-center shadow-3xs p-1">
                                                <img src="{{ asset('images/logos/logo_vetcare.jpg') }}" class="h-full w-full rounded-xl object-cover" alt="Mascota">
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-extrabold text-lg text-purple-950 leading-snug">{{ $pet->name }}</h4>
                                            @if(strtolower($pet->species) === 'perro')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-3xs font-extrabold bg-purple-50 text-purple-700 border border-purple-200/50 uppercase tracking-wider mt-0.5 shadow-3xs">Perro</span>
                                            @elseif(strtolower($pet->species) === 'gato')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-3xs font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-200/50 uppercase tracking-wider mt-0.5 shadow-3xs">Gato</span>
                                            @elseif(strtolower($pet->species) === 'ave')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-3xs font-extrabold bg-teal-50 text-teal-700 border border-teal-200/50 uppercase tracking-wider mt-0.5 shadow-3xs">Ave</span>
                                            @elseif(strtolower($pet->species) === 'conejo')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-3xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200/50 uppercase tracking-wider mt-0.5 shadow-3xs">Conejo</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-3xs font-extrabold bg-gray-50 text-gray-700 border border-gray-200/50 uppercase tracking-wider mt-0.5 shadow-3xs">{{ $pet->species }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-y-2 text-xs pt-3 border-t border-purple-100/50 text-purple-950">
                                        <div>
                                            <span class="block text-3xs text-purple-700/70 font-bold uppercase tracking-wider">Raza</span>
                                            <span class="font-extrabold text-purple-950 flex items-center gap-1 mt-0.5">
                                                <svg class="h-3.5 w-3.5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                                </svg>
                                                <span>{{ $pet->breed }}</span>
                                            </span>
                                        </div>
                                        <div>
                                            <span class="block text-3xs text-purple-700/70 font-bold uppercase tracking-wider">Peso</span>
                                            <span class="font-extrabold text-purple-950 flex items-center gap-1 mt-0.5">
                                                <svg class="h-3.5 w-3.5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                                </svg>
                                                <span>{{ $pet->weight }} kg</span>
                                            </span>
                                        </div>
                                        <div class="col-span-2">
                                            <span class="block text-3xs text-purple-700/70 font-bold uppercase tracking-wider">Edad</span>
                                            <span class="font-extrabold text-purple-950 flex items-center gap-1 mt-0.5">
                                                <svg class="h-3.5 w-3.5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>
                                                    {{ \Carbon\Carbon::parse($pet->birthdate)->age }} años 
                                                    <span class="text-3xs text-gray-500 font-semibold">({{ \Carbon\Carbon::parse($pet->birthdate)->format('d/m/Y') }})</span>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 pt-3 border-t border-purple-100/50 flex justify-end gap-2">
                                    <a href="{{ route('pets.show', $pet) }}" class="inline-flex items-center px-3.5 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 text-xs font-extrabold rounded-xl transition-all shadow-3xs border border-purple-200/50">
                                        Ver Ficha
                                    </a>
                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'recepcionista')
                                        <a href="{{ route('pets.edit', $pet) }}" class="inline-flex items-center px-3.5 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-extrabold rounded-xl transition-all shadow-3xs border border-indigo-200/50">
                                            Editar
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
