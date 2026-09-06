<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crear cuenta | Delta System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulseGlow {
            0%, 100% {
                opacity: .25;
                transform: scale(1);
            }

            50% {
                opacity: .55;
                transform: scale(1.1);
            }
        }

        .float {
            animation: float 5s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulseGlow 5s ease-in-out infinite;
        }

        .circuit-bg {
            background-image:
                linear-gradient(rgba(14, 165, 233, .05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, .05) 1px, transparent 1px);
            background-size: 42px 42px;
        }

        .dark .circuit-bg {
            background-image:
                linear-gradient(rgba(56, 189, 248, .055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, .055) 1px, transparent 1px);
        }
    </style>
</head>


<body
    class="min-h-screen bg-slate-50 text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-white"
>

    {{-- Fondo --}}

    <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">

        <div
            class="absolute -left-40 -top-40 h-[32rem] w-[32rem] rounded-full bg-cyan-300/20 blur-[100px] dark:bg-cyan-500/10">
        </div>

        <div
            class="absolute -bottom-40 -right-40 h-[32rem] w-[32rem] rounded-full bg-blue-300/20 blur-[100px] dark:bg-blue-500/10">
        </div>

    </div>



    {{-- Navbar --}}

    <header class="absolute left-0 right-0 top-0 z-20">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">

            <a
                href="{{ url('/') }}"
                class="flex items-center gap-3"
            >

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 text-white shadow-lg dark:bg-white dark:text-slate-950"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3 4 18h16L12 3Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.5 14h7"
                        />
                    </svg>

                </div>


                <div>

                    <p class="text-sm font-bold">
                        Delta System
                    </p>

                    <p class="text-[9px] font-semibold uppercase tracking-[.18em] text-slate-400">
                        Repair technology
                    </p>

                </div>

            </a>


            <button
                id="theme-toggle"
                type="button"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
            >

                <svg
                    id="moon-icon"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-5 w-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"
                    />
                </svg>


                <svg
                    id="sun-icon"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="hidden h-5 w-5"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42"
                    />
                </svg>

            </button>

        </div>

    </header>



    <main class="relative flex min-h-screen items-center justify-center px-6 py-28 lg:px-8">

        <div class="circuit-bg pointer-events-none absolute inset-0 -z-10"></div>


        <div class="grid w-full max-w-6xl items-center gap-16 lg:grid-cols-2">


            {{-- =====================================================
                TEXTO
            ====================================================== --}}

            <div class="hidden lg:block">

                <div class="max-w-xl">

                    <div
                        class="mb-6 inline-flex items-center gap-2 rounded-full border border-cyan-200 bg-white/80 px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm dark:border-cyan-900/60 dark:bg-slate-900/70 dark:text-slate-300"
                    >

                        <span class="h-2 w-2 rounded-full bg-cyan-500"></span>

                        Empieza en unos segundos.

                    </div>


                    <h1
                        class="text-5xl font-black leading-[1] tracking-[-.04em] text-slate-950 xl:text-6xl dark:text-white"
                    >

                        Ten el control de
                        <span class="text-cyan-500">
                            tu reparación.
                        </span>

                    </h1>


                    <p
                        class="mt-6 max-w-lg text-lg leading-8 text-slate-500 dark:text-slate-400"
                    >
                        Crea tu cuenta en Delta System y mantén a la mano
                        la información relacionada con tus servicios
                        de reparación.
                    </p>


                    {{-- Beneficios --}}

                    <div class="mt-10 space-y-4">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6v6l4 2"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    />

                                </svg>

                            </div>


                            <div>

                                <p class="text-sm font-bold text-slate-800 dark:text-white">
                                    Consulta tu reparación
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Mantente al tanto del proceso.
                                </p>

                            </div>

                        </div>



                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-400"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 12c0 4.97-4.03 9-9 9a8.96 8.96 0 0 1-3.33-.64L3 21l1.64-5.67A8.96 8.96 0 0 1 3 12a9 9 0 1 1 18 0Z"
                                    />

                                </svg>

                            </div>


                            <div>

                                <p class="text-sm font-bold text-slate-800 dark:text-white">
                                    Información clara
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Todo lo importante, en un solo lugar.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Equipo flotante --}}

                    <div class="relative mt-12 h-32">

                        <div
                            class="pulse-glow absolute left-8 top-0 h-32 w-32 rounded-full bg-cyan-400/20 blur-[60px]"
                        ></div>


                        <div class="float absolute left-2 top-0">

                            <div
                                class="flex h-28 w-44 items-center justify-center rounded-2xl border border-slate-300 bg-white shadow-xl dark:border-slate-700 dark:bg-slate-900"
                            >

                                <div class="flex items-center gap-4">

                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-300"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.6"
                                            stroke="currentColor"
                                            class="h-7 w-7"
                                        >
                                            <rect
                                                width="14"
                                                height="20"
                                                x="5"
                                                y="2"
                                                rx="2"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>


                                    <div>

                                        <div class="h-2 w-16 rounded-full bg-slate-200 dark:bg-slate-700"></div>

                                        <div class="mt-2 h-2 w-11 rounded-full bg-cyan-200 dark:bg-cyan-900"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =====================================================
                REGISTER
            ====================================================== --}}

            <div class="w-full max-w-md justify-self-center lg:justify-self-end">

                <div
                    class="rounded-[2rem] border border-slate-200 bg-white/90 p-7 shadow-2xl shadow-slate-950/10 backdrop-blur-xl sm:p-9 dark:border-slate-800 dark:bg-slate-900/90"
                >

                    <div class="mb-7">

                        <div
                            class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-950 text-white dark:bg-white dark:text-slate-950"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.7"
                                stroke="currentColor"
                                class="h-6 w-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 3.75-1.606A9.28 9.28 0 0 0 21 15.75M15 19.128v-.003c0-1.055-.42-2.07-1.172-2.814A4.5 4.5 0 0 0 10.5 15H9a4.5 4.5 0 0 0-3.328 1.311A3.98 3.98 0 0 0 4.5 19.125v.003A9.38 9.38 0 0 0 8.25 20.734M15 19.128A9.38 9.38 0 0 1 8.25 20.734M15 19.128a9.38 9.38 0 0 0 3.75-1.606A9.28 9.28 0 0 0 21 15.75M8.25 20.734a9.38 9.38 0 0 1-3.75-1.606A9.28 9.28 0 0 1 3 15.75"
                                />

                                <circle
                                    cx="12"
                                    cy="7"
                                    r="4"
                                />

                            </svg>

                        </div>


                        <h2 class="text-2xl font-black tracking-tight text-slate-950 dark:text-white">
                            Crear cuenta
                        </h2>


                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                            Regístrate para comenzar a utilizar Delta System.
                        </p>

                    </div>



                    <form method="POST" action="{{ route('register') }}">

                        @csrf


                        {{-- NOMBRE --}}

                        <div>

                            <label
                                for="name"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Nombre
                            </label>


                            <div class="relative mt-2">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="h-5 w-5"
                                    >
                                        <circle
                                            cx="12"
                                            cy="7"
                                            r="4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 21a7 7 0 0 1 14 0"
                                        />
                                    </svg>

                                </div>


                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Tu nombre"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            @if ($errors->get('name'))

                                <p class="mt-2 text-xs font-medium text-red-500">
                                    {{ $errors->first('name') }}
                                </p>

                            @endif

                        </div>



                        {{-- EMAIL --}}

                        <div class="mt-5">

                            <label
                                for="email"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Correo electrónico
                            </label>


                            <div class="relative mt-2">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.69 5.214a2.25 2.25 0 0 1-2.32 0L2.25 6.75"
                                        />
                                    </svg>

                                </div>


                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="username"
                                    placeholder="tu@correo.com"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            @if ($errors->get('email'))

                                <p class="mt-2 text-xs font-medium text-red-500">
                                    {{ $errors->first('email') }}
                                </p>

                            @endif

                        </div>



                        {{-- PASSWORD --}}

                        <div class="mt-5">

                            <label
                                for="password"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Contraseña
                            </label>


                            <div class="relative mt-2">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5a2.25 2.25 0 0 1-2.25-2.25v-6A2.25 2.25 0 0 1 6.75 10.5Z"
                                        />
                                    </svg>

                                </div>


                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="••••••••"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            @if ($errors->get('password'))

                                <p class="mt-2 text-xs font-medium text-red-500">
                                    {{ $errors->first('password') }}
                                </p>

                            @endif

                        </div>



                        {{-- CONFIRM PASSWORD --}}

                        <div class="mt-5">

                            <label
                                for="password_confirmation"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Confirmar contraseña
                            </label>


                            <div class="relative mt-2">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75"
                                        />

                                        <rect
                                            width="18"
                                            height="18"
                                            x="3"
                                            y="3"
                                            rx="4"
                                        />

                                    </svg>

                                </div>


                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="••••••••"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            @if ($errors->get('password_confirmation'))

                                <p class="mt-2 text-xs font-medium text-red-500">
                                    {{ $errors->first('password_confirmation') }}
                                </p>

                            @endif

                        </div>



                        {{-- BOTÓN --}}

                        <button
                            type="submit"
                            class="group mt-7 flex w-full items-center justify-center gap-3 rounded-xl bg-slate-950 px-5 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-950/10 transition duration-300 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                        >

                            Crear mi cuenta

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13 7l5 5m0 0-5 5m5-5H6"
                                />
                            </svg>

                        </button>

                    </form>



                    {{-- LOGIN --}}

                    <div class="mt-7 border-t border-slate-100 pt-6 text-center dark:border-slate-800">

                        <p class="text-sm text-slate-500 dark:text-slate-400">

                            ¿Ya tienes una cuenta?

                            <a
                                href="{{ route('login') }}"
                                class="font-bold text-cyan-600 transition hover:text-cyan-500 dark:text-cyan-400"
                            >
                                Inicia sesión
                            </a>

                        </p>

                    </div>

                </div>


                <p class="mt-6 text-center text-xs text-slate-400">
                    © {{ date('Y') }} Delta System
                </p>

            </div>

        </div>

    </main>



    <script>

        const themeToggle = document.getElementById('theme-toggle');

        const sunIcon = document.getElementById('sun-icon');

        const moonIcon = document.getElementById('moon-icon');


        function updateThemeIcons() {

            const isDark =
                document.documentElement.classList.contains('dark');

            sunIcon.classList.toggle('hidden', !isDark);

            moonIcon.classList.toggle('hidden', isDark);

        }


        function applyTheme(theme) {

            if (theme === 'dark') {

                document.documentElement.classList.add('dark');

            } else {

                document.documentElement.classList.remove('dark');

            }

            localStorage.setItem('delta-theme', theme);

            updateThemeIcons();

        }


        const savedTheme =
            localStorage.getItem('delta-theme');


        if (savedTheme) {

            applyTheme(savedTheme);

        } else {

            applyTheme(
                window.matchMedia('(prefers-color-scheme: dark)').matches
                    ? 'dark'
                    : 'light'
            );

        }


        themeToggle.addEventListener('click', () => {

            const isDark =
                document.documentElement.classList.contains('dark');

            applyTheme(
                isDark ? 'light' : 'dark'
            );

        });

    </script>

</body>

</html>