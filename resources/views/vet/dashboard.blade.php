<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight flex items-center gap-2">
            <svg class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            {{ __('Panel de Consultas Veterinarias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Greeting & Quick Stats Header -->
            <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-950 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            Rol: Veterinario Clínico
                        </span>
                        <h1 class="text-3xl font-extrabold mt-3 tracking-tight">¡Hola, {{ Auth::user()->name }}!</h1>
                        <p class="text-slate-400 mt-1">Monitorea tus pacientes asignados, agenda de hoy e historial clínico veterinario.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-white/5 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10 shadow-sm text-center">
                            <span class="text-xs text-slate-400 block uppercase font-bold tracking-wider">Citas Hoy</span>
                            <span class="text-2xl font-bold mt-1 block text-amber-400">0 Pendientes</span>
                        </div>
                        <div class="bg-white/5 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10 shadow-sm text-center">
                            <span class="text-xs text-slate-400 block uppercase font-bold tracking-wider">Mascotas Totales</span>
                            <span class="text-2xl font-bold mt-1 block">0 Activas</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Quick Patients / Records management -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-800/50 space-y-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-indigo-500"></span>
                        Herramientas Clínicas
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="#" class="group p-5 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-indigo-500/30 dark:hover:border-indigo-500/20 hover:bg-indigo-50/5 dark:hover:bg-indigo-950/5 transition-all duration-200">
                            <div class="h-10 w-10 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-indigo-500 transition-colors">Historial Médico</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Registra diagnósticos, tratamientos y recetas de consulta.</p>
                        </a>

                        <a href="#" class="group p-5 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-purple-500/30 dark:hover:border-purple-500/20 hover:bg-purple-50/5 dark:hover:bg-purple-950/5 transition-all duration-200">
                            <div class="h-10 w-10 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-purple-500 transition-colors">Vacunación</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Registra la aplicación de vacunas y próximas fechas sugeridas.</p>
                        </a>
                    </div>
                </div>

                <!-- Next Consultations -->
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-800/50">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-purple-500"></span>
                        Próximas Citas Médicas
                    </h3>
                    
                    <div class="text-center py-8">
                        <div class="h-16 w-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 mx-auto mb-4 border border-slate-200/20 shadow-sm">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-700 dark:text-gray-300">No hay consultas programadas</h4>
                        <p class="text-xs text-gray-500 mt-1">Las citas agendadas por recepción con tu nombre asignado aparecerán aquí.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
