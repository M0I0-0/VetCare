<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight flex items-center gap-2">
            <svg class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ __('Recepción y Gestión de Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Greeting & Quick Stats Header -->
            <div class="bg-gradient-to-r from-slate-900 via-teal-950 to-slate-950 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-teal-500/20 text-teal-300 border border-teal-500/30">
                            Rol: Recepción de Pacientes
                        </span>
                        <h1 class="text-3xl font-extrabold mt-3 tracking-tight">¡Hola, {{ Auth::user()->name }}!</h1>
                        <p class="text-slate-400 mt-1">Registra dueños, mascotas y programa citas veterinarias de forma rápida y eficiente.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-white/5 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10 shadow-sm text-center">
                            <span class="text-xs text-slate-400 block uppercase font-bold tracking-wider">Citas Agendadas</span>
                            <span class="text-2xl font-bold mt-1 block">0 Activas</span>
                        </div>
                        <div class="bg-white/5 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10 shadow-sm text-center">
                            <span class="text-xs text-slate-400 block uppercase font-bold tracking-wider">Último Ingreso</span>
                            <span class="text-2xl font-bold mt-1 block text-teal-400">Hoy</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reception Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Quick Management Tasks -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-800/50 space-y-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-teal-500"></span>
                        Acceso Rápido Recepción
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="#" class="group p-5 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-teal-500/30 dark:hover:border-teal-500/20 hover:bg-teal-50/5 dark:hover:bg-teal-950/5 transition-all duration-200">
                            <div class="h-10 w-10 rounded-xl bg-teal-500/10 text-teal-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-teal-500 transition-colors">Registrar Dueño</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ingresa los datos de contacto del dueño de la mascota.</p>
                        </a>

                        <a href="#" class="group p-5 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-emerald-500/30 dark:hover:border-emerald-500/20 hover:bg-emerald-50/5 dark:hover:bg-emerald-950/5 transition-all duration-200">
                            <div class="h-10 w-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-emerald-500 transition-colors">Registrar Mascota</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ingresa los datos principales de una nueva mascota paciente.</p>
                        </a>

                        <a href="#" class="group p-5 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-sky-500/30 dark:hover:border-sky-500/20 hover:bg-sky-50/5 dark:hover:bg-sky-950/5 transition-all duration-200 sm:col-span-2">
                            <div class="h-10 w-10 rounded-xl bg-sky-500/10 text-sky-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-sky-500 transition-colors">Agendar Nueva Cita</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Programa una cita para consulta veterinaria y asígnale un médico.</p>
                        </a>
                    </div>
                </div>

                <!-- Daily appointments -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-800/50">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-teal-500"></span>
                        Citas del Día
                    </h3>
                    
                    <div class="text-center py-12">
                        <div class="h-16 w-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 mx-auto mb-4 border border-slate-200/20 shadow-sm">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-700 dark:text-gray-300">Agenda libre por hoy</h4>
                        <p class="text-xs text-gray-500 mt-1">Las citas que se programen para el día de hoy aparecerán listadas aquí.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
