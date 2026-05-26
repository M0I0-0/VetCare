<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-purple-950 leading-tight flex items-center gap-2">
                <a href="{{ route('admin.users.index') }}" class="text-purple-400 hover:text-purple-600 transition-colors mr-2">
                    <svg class="h-6 w-6 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <span>{{ __('Registrar Nuevo Miembro de Personal') }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.2rem] shadow-3xs border border-[#e2d8f7] overflow-hidden">
                <div class="p-6 border-b border-[#e2d8f7] bg-purple-50/10 flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center shadow-3xs">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-purple-950 text-base">Datos de la Cuenta</h3>
                        <p class="text-xs text-gray-500 font-semibold mt-0.5">Asigna un nombre, correo electrónico y rol en el sistema.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}" class="p-8 space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Nombre Completo</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ej. Dra. Diana Prince"
                            class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs" />
                        @error('name')
                            <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Correo Electrónico</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@vetcare.com"
                            class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs" />
                        @error('email')
                            <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Rol del Sistema</label>
                        <select id="role" name="role" required
                            class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs">
                            <option value="" disabled selected>Selecciona un rol...</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador (Control Total)</option>
                            <option value="veterinario" {{ old('role') === 'veterinario' ? 'selected' : '' }}>Veterinario (Acciones Clínicas y Consultas)</option>
                            <option value="recepcionista" {{ old('role') === 'recepcionista' ? 'selected' : '' }}>Recepcionista (Altas y Citas de lectura)</option>
                        </select>
                        @error('role')
                            <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Contraseña</label>
                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs" />
                            @error('password')
                                <p class="text-rose-500 text-xs mt-2 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-black text-purple-950 uppercase tracking-wider mb-2">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                                class="w-full px-4 py-3 rounded-2xl border border-purple-150 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm font-semibold text-purple-950 transition-colors shadow-3xs" />
                        </div>
                    </div>

                    <!-- Submit & Back Buttons -->
                    <div class="pt-6 border-t border-purple-50/50 flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-5 py-2.5 bg-purple-50 border border-purple-200/50 hover:bg-purple-100 text-purple-700 font-bold text-sm rounded-2xl transition-all shadow-3xs">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 hover:shadow-lg hover:shadow-purple-500/20 text-white font-bold text-sm rounded-2xl transform hover:-translate-y-0.5 transition-all duration-150">
                            Registrar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
