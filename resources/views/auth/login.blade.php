<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Iniciar sesión | Delta System</title>

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


    {{-- Navbar pequeña --}}

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
                        d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42-1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M6.35 6.35l1.42-1.42"
                    />
                </svg>

            </button>

        </div>

    </header>



    <main class="relative flex min-h-screen items-center justify-center px-6 py-28 lg:px-8">

        <div class="circuit-bg pointer-events-none absolute inset-0 -z-10"></div>


        <div class="grid w-full max-w-6xl items-center gap-16 lg:grid-cols-2">


            {{-- =====================================================
                LADO IZQUIERDO
            ====================================================== --}}

            <div class="hidden lg:block">

                <div class="max-w-xl">

                    <div
                        class="mb-6 inline-flex items-center gap-2 rounded-full border border-cyan-200 bg-white/80 px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm dark:border-cyan-900/60 dark:bg-slate-900/70 dark:text-slate-300"
                    >

                        <span class="h-2 w-2 rounded-full bg-cyan-500"></span>

                        Tu reparación, bajo control.

                    </div>


                    <h1
                        class="text-5xl font-black leading-[1] tracking-[-.04em] text-slate-950 xl:text-6xl dark:text-white"
                    >

                        Bienvenido de nuevo.

                    </h1>


                    <p
                        class="mt-6 max-w-lg text-lg leading-8 text-slate-500 dark:text-slate-400"
                    >
                        Accede a tu cuenta para consultar la información
                        de tus servicios y mantener el control de tus
                        reparaciones.
                    </p>


                    {{-- Visual --}}

                    <div class="relative mt-12 h-52">

                        <div
                            class="pulse-glow absolute left-16 top-4 h-44 w-44 rounded-full bg-cyan-400/20 blur-[70px]"
                        ></div>


                        <div class="float absolute left-8 top-2">

                            <div
                                class="relative flex h-44 w-28 items-center justify-center rounded-[1.7rem] border-2 border-slate-300 bg-white shadow-2xl shadow-slate-900/10 dark:border-slate-700 dark:bg-slate-900"
                            >

                                <div
                                    class="h-32 w-20 rounded-xl border border-slate-200 bg-gradient-to-b from-slate-100 to-slate-200 dark:border-slate-700 dark:from-slate-800 dark:to-slate-950"
                                >

                                    <div
                                        class="mx-auto mt-2 h-1 w-5 rounded-full bg-slate-300 dark:bg-slate-600"
                                    ></div>


                                    <div
                                        class="mx-auto mt-9 flex h-9 w-9 items-center justify-center rounded-full bg-cyan-100 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400"
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
                                                d="M14.7 6.3a4.5 4.5 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4.5 4.5 0 0 0 5.4-5.4l-2.5 2.5-2.8-.7-.7-2.8 2.5-2.5Z"
                                            />
                                        </svg>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Estado flotante --}}

                        <div
                            class="absolute left-40 top-16 rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-xl dark:border-slate-800 dark:bg-slate-900"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-400"
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
                                            d="m5 12 4 4L19 6"
                                        />
                                    </svg>

                                </div>


                                <div>

                                    <p class="text-xs font-bold text-slate-800 dark:text-white">
                                        Todo en un solo lugar
                                    </p>

                                    <p class="mt-0.5 text-[10px] text-slate-400">
                                        Consulta cuando quieras
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =====================================================
                LOGIN
            ====================================================== --}}

            <div class="w-full max-w-md justify-self-center lg:justify-self-end">

                <div
                    class="rounded-[2rem] border border-slate-200 bg-white/90 p-7 shadow-2xl shadow-slate-950/10 backdrop-blur-xl sm:p-9 dark:border-slate-800 dark:bg-slate-900/90"
                >

                    {{-- Encabezado --}}

                    <div class="mb-8">

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
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-9a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 4.5 21h9a2.25 2.25 0 0 0 2.25-2.25V15"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8.25 12h12m0 0-3.75-3.75M20.25 12l-3.75 3.75"
                                />
                            </svg>

                        </div>


                        <h2 class="text-2xl font-black tracking-tight text-slate-950 dark:text-white">
                            Iniciar sesión
                        </h2>


                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                            Accede a tu cuenta de Delta System.
                        </p>

                    </div>



                    {{-- Session status --}}

                    @if (session('status'))

                        <div
                            class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-400"
                        >
                            {{ session('status') }}
                        </div>

                    @endif



                    <form method="POST" action="{{ route('login') }}">

                        @csrf


                        {{-- EMAIL --}}

                        <div>

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
                                    autofocus
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

                            <div class="flex items-center justify-between">

                                <label
                                    for="password"
                                    class="text-sm font-semibold text-slate-700 dark:text-slate-300"
                                >
                                    Contraseña
                                </label>


                                @if (Route::has('password.request'))

                                    <a
                                        href="{{ route('password.request') }}"
                                        class="text-xs font-semibold text-cyan-600 transition hover:text-cyan-500 dark:text-cyan-400"
                                    >
                                        ¿La olvidaste?
                                    </a>

                                @endif

                            </div>


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
                                    autocomplete="current-password"
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



                        {{-- RECORDAR --}}

                        <label class="mt-5 flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950"
                            >

                            <span class="text-sm text-slate-500 dark:text-slate-400">
                                Mantener mi sesión iniciada
                            </span>

                        </label>



                        {{-- BOTÓN --}}

                        <button
                            type="submit"
                            class="group mt-7 flex w-full items-center justify-center gap-3 rounded-xl bg-slate-950 px-5 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-950/10 transition duration-300 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                        >

                            Entrar a Delta System

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



                    {{-- REGISTRO --}}

                    @if (Route::has('register'))

                        <div class="mt-7 border-t border-slate-100 pt-6 text-center dark:border-slate-800">

                            <p class="text-sm text-slate-500 dark:text-slate-400">

                                ¿Aún no tienes una cuenta?

                                <a
                                    href="{{ route('register') }}"
                                    class="font-bold text-cyan-600 transition hover:text-cyan-500 dark:text-cyan-400"
                                >
                                    Regístrate
                                </a>

                            </p>

                        </div>

                    @endif

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