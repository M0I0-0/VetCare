<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Iniciar Sesión - {{ config('app.name', 'VetCare') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif !important;
        }
    </style>
</head>
<body class="h-full bg-white text-[#2d1b7a] antialiased flex">

    <div class="w-full min-h-screen flex flex-col lg:flex-row">
        
        <!-- PANEL IZQUIERDO: Formulario de Acceso (40%) -->
        <div class="w-full lg:w-[40%] xl:w-[35%] bg-white flex flex-col justify-between p-8 sm:p-12 md:p-16 lg:p-10 xl:p-14 relative z-10 shadow-2xl">
            
            <!-- Cabecera de Logo (Inspiración SeedProd) -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logos/logo_vetcare.jpg') }}" class="h-10 w-10 rounded-xl object-cover shadow-xs border border-[#e2d8f7]/50" alt="VetCare Logo">
                <span class="font-extrabold text-2.5xl tracking-tight text-purple-950">VetCare</span>
            </div>

            <!-- Formulario Central -->
            <div class="my-auto py-8 max-w-sm w-full mx-auto">
                <h1 class="text-4xl font-extrabold tracking-tight text-purple-950">Login</h1>
                <p class="text-sm font-semibold text-gray-500 mt-2">
                    ¿No tienes una cuenta? 
                    <a href="{{ route('register') }}" class="text-[#6366f1] hover:text-[#4f46e5] hover:underline font-bold transition-all">Obtén VetCare Ahora</a>
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mt-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-bold text-gray-500 uppercase tracking-wider block">Correo Electrónico</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                                class="w-full pr-11 pl-4 py-3 rounded-xl border @error('email') border-rose-300 focus:ring-rose-400 @else border-[#e2d8f7] focus:ring-purple-400 focus:border-transparent @enderror bg-white text-purple-950 text-sm font-semibold shadow-xs focus:outline-none focus:ring-2 transition-all"
                                placeholder="tu@correo.com">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-xs text-rose-500 font-bold mt-1.5 flex items-center gap-1">
                                <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="text-xs font-bold text-gray-500 uppercase tracking-wider block">Contraseña</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full pr-11 pl-4 py-3 rounded-xl border @error('password') border-rose-300 focus:ring-rose-400 @else border-[#e2d8f7] focus:ring-purple-400 focus:border-transparent @enderror bg-white text-purple-950 text-sm font-semibold shadow-xs focus:outline-none focus:ring-2 transition-all"
                                placeholder="••••••••••••">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-xs text-rose-500 font-bold mt-1.5 flex items-center gap-1">
                                <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                            <input id="remember_me" type="checkbox" name="remember" 
                                class="rounded bg-white border-[#e2d8f7] text-[#6366f1] shadow-xs focus:ring-[#6366f1] focus:ring-offset-0 focus:outline-none h-4 w-4 transition-all">
                            <span class="ms-2.5 text-xs text-gray-500 font-bold">{{ __('Recordarme') }}</span>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div>
                        <button type="submit" class="w-full py-3.5 px-6 bg-[#6366f1] hover:bg-[#4f46e5] text-white font-extrabold text-sm rounded-xl transition-all shadow-md shadow-indigo-500/10 hover:shadow-lg hover:shadow-indigo-500/20 text-center flex justify-center items-center gap-2">
                            <span>Ingresar</span>
                        </button>
                    </div>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="text-center mt-4">
                            <a href="{{ route('password.request') }}" class="text-xs text-gray-500 hover:text-purple-950 hover:underline transition-colors font-bold">¿Olvidaste tu contraseña?</a>
                        </div>
                    @endif

                </form>
            </div>

            <!-- Footer (Inspiración SeedProd) -->
            <div class="text-center mt-auto pt-8 text-[11px] font-semibold text-gray-400 leading-relaxed">
                <p>Copyright &copy; {{ date('Y') }} VetCare, LLC. VetCare&trade; es una marca registrada de VetCare, LLC.</p>
                <div class="mt-1 flex justify-center gap-3 font-bold text-gray-500">
                    <a href="#" class="hover:underline">Términos de Servicio</a>
                    <span>|</span>
                    <a href="#" class="hover:underline">Política de Privacidad</a>
                </div>
            </div>

        </div>

        <!-- PANEL DERECHO: Ilustración Veterinaria Premium (60%) -->
        <div class="hidden lg:flex lg:w-[60%] xl:w-[65%] relative overflow-hidden bg-purple-950 items-center justify-center">
            <!-- Background Image -->
            <img src="{{ asset('images/vet_login_art.png') }}" class="absolute inset-0 w-full h-full object-cover select-none" alt="Veterinary Art Background">
            
            <!-- Sleek overlay to integrate colors -->
            <div class="absolute inset-0 bg-gradient-to-tr from-purple-950/80 via-indigo-950/40 to-transparent"></div>

            <!-- Curved Concentric SVG Overlay -->
            <svg class="absolute inset-0 w-full h-full opacity-35" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M-10 100 C 30 70, 70 30, 110 0" stroke="url(#line-grad)" stroke-width="0.15" />
                <path d="M-10 110 C 30 80, 80 40, 110 10" stroke="url(#line-grad)" stroke-width="0.15" />
                <path d="M-10 120 C 30 90, 90 50, 110 20" stroke="url(#line-grad)" stroke-width="0.15" />
                <path d="M-10 90 C 20 60, 60 20, 110 -10" stroke="url(#line-grad)" stroke-width="0.15" />
                
                <defs>
                    <linearGradient id="line-grad" x1="0" y1="1" x2="1" y2="0">
                        <stop offset="0%" stop-color="#a855f7" />
                        <stop offset="50%" stop-color="#6366f1" />
                        <stop offset="100%" stop-color="#3b82f6" />
                    </linearGradient>
                </defs>
            </svg>

            <!-- Centered Glassmorphic Message Box -->
            <div class="absolute bottom-16 left-16 right-16 bg-white/10 backdrop-blur-xl border border-white/15 p-8 rounded-[2.2rem] shadow-2xl max-w-xl text-white transform hover:scale-[1.01] transition-transform duration-300">
                <span class="px-3.5 py-1.5 rounded-full text-3xs font-extrabold bg-white/20 text-purple-100 border border-white/20 tracking-wider uppercase">
                    Plataforma Clínica Premium
                </span>
                <h2 class="text-3xl font-black mt-4 leading-tight tracking-tight">Cuidado con Amor,<br>Gestión con Precisión.</h2>
                <p class="text-purple-100/80 mt-2 text-sm font-semibold leading-relaxed">
                    La plataforma digital más avanzada para el control clínico de tus pacientes. Administra citas, vacunas e historias clínicas en un entorno visual excepcional.
                </p>
                <div class="flex gap-1.5 mt-6">
                    <span class="h-2 w-8 rounded-full bg-white"></span>
                    <span class="h-2 w-2 rounded-full bg-white/40"></span>
                    <span class="h-2 w-2 rounded-full bg-white/40"></span>
                </div>
            </div>

        </div>

    </div>

</body>
</html>
