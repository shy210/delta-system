<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Delta System | Tu reparación, bajo control</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        /* =====================================================
           ANIMACIONES
        ====================================================== */

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeRight {
            from {
                opacity: 0;
                transform: translateX(35px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-12px) rotate(.5deg);
            }
        }

        @keyframes floatSlow {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }

        @keyframes pulseGlow {
            0%,
            100% {
                opacity: .35;
                transform: scale(1);
            }

            50% {
                opacity: .65;
                transform: scale(1.12);
            }
        }

        @keyframes circuit {
            0% {
                stroke-dashoffset: 1000;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scan {
            0% {
                top: -20%;
            }

            100% {
                top: 120%;
            }
        }

        @keyframes blink {
            0%,
            100% {
                opacity: .35;
            }

            50% {
                opacity: 1;
            }
        }

        .fade-up {
            animation: fadeUp .85s ease-out both;
        }

        .fade-right {
            animation: fadeRight .9s ease-out .15s both;
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        .float-slow {
            animation: floatSlow 5s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulseGlow 5s ease-in-out infinite;
        }

        .blink {
            animation: blink 2s ease-in-out infinite;
        }

        .delay-1 {
            animation-delay: .15s;
        }

        .delay-2 {
            animation-delay: .3s;
        }

        .delay-3 {
            animation-delay: .45s;
        }

        .delay-4 {
            animation-delay: .6s;
        }

        /* =====================================================
           FONDO TIPO CIRCUITO
        ====================================================== */

        .circuit-bg {
            background-image:
                linear-gradient(rgba(14, 165, 233, .045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, .045) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        .dark .circuit-bg {
            background-image:
                linear-gradient(rgba(56, 189, 248, .06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, .06) 1px, transparent 1px);
        }

        .glass {
            background: rgba(255, 255, 255, .72);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .dark .glass {
            background: rgba(15, 23, 42, .72);
        }

        .text-gradient {
            background: linear-gradient(
                110deg,
                #0f172a 0%,
                #0ea5e9 55%,
                #2563eb 100%
            );

            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .dark .text-gradient {
            background: linear-gradient(
                110deg,
                #ffffff 0%,
                #67e8f9 55%,
                #60a5fa 100%
            );

            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>


<body
    class="bg-slate-50 text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-white"
>


    {{-- =========================================================
        FONDO DECORATIVO
    ========================================================== --}}

    <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">

        <div
            class="absolute -left-48 -top-48 h-[38rem] w-[38rem] rounded-full bg-cyan-300/20 blur-[110px] dark:bg-cyan-500/10">
        </div>

        <div
            class="absolute right-[-15rem] top-[15%] h-[36rem] w-[36rem] rounded-full bg-blue-300/20 blur-[110px] dark:bg-blue-500/10">
        </div>

        <div
            class="absolute bottom-[-15rem] left-[30%] h-[32rem] w-[32rem] rounded-full bg-indigo-300/10 blur-[110px] dark:bg-indigo-500/5">
        </div>

    </div>


    {{-- =========================================================
        NAVBAR
    ========================================================== --}}

    <header class="relative z-50">

        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">

            {{-- LOGO --}}

            <a
                href="{{ url('/') }}"
                class="group flex items-center gap-3"
            >

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-xl shadow-slate-950/20 transition duration-300 group-hover:rotate-3 group-hover:scale-105 dark:bg-white dark:text-slate-950"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-6 w-6"
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

                    <div class="text-lg font-bold tracking-tight">
                        Delta System
                    </div>

                    <div class="text-[10px] font-semibold uppercase tracking-[.18em] text-slate-400">
                        Repair technology
                    </div>

                </div>

            </a>


            {{-- ACCIONES --}}

            <div class="flex items-center gap-2 sm:gap-3">

                {{-- TEMA --}}

                <button
                    id="theme-toggle"
                    type="button"
                    aria-label="Cambiar tema"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition hover:-translate-y-0.5 hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
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


                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-xl bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                    >
                        Mi cuenta
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 sm:block dark:text-slate-300 dark:hover:bg-slate-900"
                    >
                        Iniciar sesión
                    </a>


                    @if (Route::has('register'))

                        <a
                            href="{{ route('register') }}"
                            class="rounded-xl bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                        >
                            Registrarme
                        </a>

                    @endif

                @endauth

            </div>

        </nav>

    </header>



    {{-- =========================================================
        HERO
    ========================================================== --}}

    <main>

        <section
            class="relative mx-auto max-w-7xl overflow-hidden px-6 pb-24 pt-10 lg:px-8 lg:pb-32 lg:pt-20"
        >

            <div class="circuit-bg pointer-events-none absolute inset-0 -z-10 opacity-70">
            </div>


            <div class="grid items-center gap-16 lg:grid-cols-[.95fr_1.05fr]">


                {{-- =================================================
                    TEXTO PRINCIPAL
                ================================================== --}}

                <div class="fade-up">

                    <div
                        class="mb-7 inline-flex items-center gap-2 rounded-full border border-cyan-200 bg-white/80 px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm backdrop-blur dark:border-cyan-900/60 dark:bg-slate-900/70 dark:text-slate-300"
                    >

                        <span class="relative flex h-2.5 w-2.5">

                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-cyan-400 opacity-60">
                            </span>

                            <span
                                class="relative h-2.5 w-2.5 rounded-full bg-cyan-500">
                            </span>

                        </span>

                        Reparaciones más simples. Clientes más tranquilos.

                    </div>


                    <h1
                        class="max-w-3xl text-5xl font-black leading-[.98] tracking-[-.04em] text-slate-950 sm:text-6xl lg:text-[5.2rem] dark:text-white"
                    >

                        Tu equipo.

                        <span class="text-gradient block">
                            En buenas manos.
                        </span>

                    </h1>


                    <p
                        class="mt-8 max-w-xl text-lg leading-8 text-slate-600 dark:text-slate-400"
                    >
                        Sigue el proceso de reparación de tu celular o
                        dispositivo electrónico de forma clara, sencilla
                        y sin perderte entre mensajes.
                    </p>


                    {{-- BOTONES --}}

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">

                        @auth

                            <a
                                href="{{ url('/dashboard') }}"
                                class="group inline-flex items-center justify-center gap-3 rounded-xl bg-slate-950 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-950/15 transition duration-300 hover:-translate-y-1 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
                            >

                                Ver mi cuenta

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

                            </a>

                        @else

                            <a
                                href="{{ route('register') }}"
                                class="group inline-flex items-center justify-center gap-3 rounded-xl bg-slate-950 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-950/15 transition duration-300 hover:-translate-y-1 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
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

                            </a>


                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-sm font-semibold text-slate-700 transition duration-300 hover:-translate-y-1 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                            >
                                Ya tengo una cuenta
                            </a>

                        @endauth

                    </div>


                    {{-- MICRO INFORMACIÓN --}}

                    <div class="mt-10 flex flex-wrap gap-x-7 gap-y-4">

                        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">

                            <span
                                class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-950 dark:text-emerald-400"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-3 w-3"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m5 12 4 4L19 6"
                                    />
                                </svg>

                            </span>

                            Seguimiento de reparación

                        </div>


                        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">

                            <span
                                class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-950 dark:text-emerald-400"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-3 w-3"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m5 12 4 4L19 6"
                                    />
                                </svg>

                            </span>

                            Información clara

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    VISUAL DEL TALLER
                ================================================== --}}

                <div class="fade-right relative">


                    {{-- Glow --}}

                    <div
                        class="pulse-glow absolute left-1/2 top-1/2 h-[25rem] w-[25rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-cyan-400/20 blur-[90px] dark:bg-cyan-500/10">
                    </div>


                    {{-- MOCKUP --}}

                    <div class="float relative mx-auto max-w-[530px]">


                        <div
                            class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white/90 p-3 shadow-2xl shadow-slate-950/10 backdrop-blur-xl dark:border-slate-800 dark:bg-slate-900/90"
                        >

                            {{-- Barra superior --}}

                            <div
                                class="flex items-center justify-between border-b border-slate-100 px-5 py-4 dark:border-slate-800"
                            >

                                <div class="flex gap-1.5">

                                    <span class="h-2.5 w-2.5 rounded-full bg-red-400"></span>

                                    <span class="h-2.5 w-2.5 rounded-full bg-yellow-400"></span>

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-400"></span>

                                </div>


                                <div class="text-[10px] font-bold tracking-[.2em] text-slate-400">
                                    DELTA SYSTEM
                                </div>


                                <div class="w-8"></div>

                            </div>


                            {{-- CONTENIDO --}}

                            <div class="p-5 sm:p-7">


                                {{-- Encabezado --}}

                                <div class="flex items-start justify-between">

                                    <div>

                                        <p class="text-xs font-medium text-slate-400">
                                            Mi reparación
                                        </p>

                                        <h3 class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                            iPhone 13 Pro
                                        </h3>

                                    </div>


                                    <span
                                        class="flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-[10px] font-bold text-amber-600 dark:bg-amber-950/40 dark:text-amber-400"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                        En reparación

                                    </span>

                                </div>


                                {{-- Línea de proceso --}}

                                <div class="mt-8">

                                    <div class="flex items-center justify-between">

                                        {{-- Paso 1 --}}

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/20"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m5 12 4 4L19 6"
                                                    />
                                                </svg>

                                            </div>

                                            <span class="mt-2 text-[9px] font-semibold text-slate-400">
                                                Recibido
                                            </span>

                                        </div>


                                        {{-- Línea --}}

                                        <div class="mx-2 h-1 flex-1 rounded-full bg-emerald-500"></div>


                                        {{-- Paso 2 --}}

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/20"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m5 12 4 4L19 6"
                                                    />
                                                </svg>

                                            </div>

                                            <span class="mt-2 text-[9px] font-semibold text-slate-400">
                                                Diagnóstico
                                            </span>

                                        </div>


                                        {{-- Línea --}}

                                        <div class="mx-2 h-1 flex-1 rounded-full bg-cyan-500"></div>


                                        {{-- Paso 3 --}}

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-cyan-500 bg-cyan-50 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M14.7 6.3a4.5 4.5 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4.5 4.5 0 0 0 5.4-5.4l-2.5 2.5-2.8-.7-.7-2.8 2.5-2.5Z"
                                                    />
                                                </svg>

                                            </div>

                                            <span class="mt-2 text-[9px] font-semibold text-cyan-600 dark:text-cyan-400">
                                                Reparando
                                            </span>

                                        </div>


                                        {{-- Línea --}}

                                        <div class="mx-2 h-1 flex-1 rounded-full bg-slate-100 dark:bg-slate-800"></div>


                                        {{-- Paso 4 --}}

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-600"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m5 12 4 4L19 6"
                                                    />
                                                </svg>

                                            </div>

                                            <span class="mt-2 text-[9px] font-semibold text-slate-400">
                                                Listo
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- Detalles --}}

                                <div
                                    class="mt-8 grid grid-cols-2 gap-3"
                                >

                                    <div
                                        class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800/70"
                                    >

                                        <p class="text-[10px] font-medium text-slate-400">
                                            Servicio
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-slate-800 dark:text-white">
                                            Cambio de pantalla
                                        </p>

                                    </div>


                                    <div
                                        class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800/70"
                                    >

                                        <p class="text-[10px] font-medium text-slate-400">
                                            Folio
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-slate-800 dark:text-white">
                                            #DS-0248
                                        </p>

                                    </div>

                                </div>


                                {{-- Mensaje --}}

                                <div
                                    class="mt-3 flex items-center gap-3 rounded-2xl border border-cyan-100 bg-cyan-50/70 p-4 dark:border-cyan-900/50 dark:bg-cyan-950/20"
                                >

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-cyan-600 shadow-sm dark:bg-slate-900 dark:text-cyan-400"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.7"
                                            stroke="currentColor"
                                            class="h-4 w-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9-1.18 0-2.3-.23-3.33-.64L3 21l1.64-5.67A8.96 8.96 0 0 1 3 12a9 9 0 1 1 18 0Z"
                                            />
                                        </svg>

                                    </div>


                                    <div>

                                        <p class="text-xs font-bold text-slate-800 dark:text-white">
                                            Reparación en proceso
                                        </p>

                                        <p class="mt-0.5 text-[10px] text-slate-400">
                                            Puedes consultar el avance de tu equipo.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- TARJETA FLOTANTE --}}

                        <div
                            class="absolute -bottom-7 -left-6 hidden rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-xl dark:border-slate-800 dark:bg-slate-900 sm:block"
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
                                        Equipo registrado
                                    </p>

                                    <p class="text-[10px] text-slate-400">
                                        Tu reparación está siendo atendida
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- TARJETA SUPERIOR --}}

                        <div
                            class="absolute -right-5 -top-6 hidden rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-xl dark:border-slate-800 dark:bg-slate-900 sm:block"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="h-4 w-4"
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

                                    <p class="text-xs font-bold text-slate-800 dark:text-white">
                                        Seguimiento
                                    </p>

                                    <p class="text-[10px] text-slate-400">
                                        Siempre informado
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
            FRANJA
        ========================================================== --}}

        <section
            class="border-y border-slate-200 bg-white/60 dark:border-slate-800 dark:bg-slate-900/30"
        >

            <div class="mx-auto max-w-7xl px-6 py-10 lg:px-8">

                <div class="flex flex-col items-center justify-between gap-6 text-center sm:flex-row sm:text-left">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-[.2em] text-cyan-600 dark:text-cyan-400">
                            Delta System
                        </p>

                        <p class="mt-2 text-lg font-bold text-slate-800 dark:text-white">
                            Tu reparación, sin perder de vista lo importante.
                        </p>

                    </div>


                    <a
                        href="#como-funciona"
                        class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-cyan-600 dark:text-slate-300 dark:hover:text-cyan-400"
                    >

                        Conoce cómo funciona

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-4 w-4 transition-transform group-hover:translate-y-1"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>

                    </a>

                </div>

            </div>

        </section>



        {{-- =========================================================
            COMO FUNCIONA
        ========================================================== --}}

        <section
            id="como-funciona"
            class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32"
        >

            <div class="mx-auto max-w-2xl text-center">

                <p class="text-sm font-bold uppercase tracking-[.2em] text-cyan-600 dark:text-cyan-400">
                    Así de sencillo
                </p>

                <h2
                    class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl dark:text-white"
                >
                    Tu reparación, paso a paso.
                </h2>

                <p class="mt-5 leading-7 text-slate-500 dark:text-slate-400">
                    Consulta la información de tu equipo y conoce en qué punto
                    se encuentra tu reparación.
                </p>

            </div>


            <div class="mt-16 grid gap-5 md:grid-cols-3">


                {{-- PASO 1 --}}

                <article
                    class="group relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-7 transition duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-cyan-950/5 dark:border-slate-800 dark:bg-slate-900"
                >

                    <div class="flex items-center justify-between">

                        <span
                            class="text-5xl font-black text-slate-100 transition duration-500 group-hover:text-cyan-100 dark:text-slate-800 dark:group-hover:text-cyan-950"
                        >
                            01
                        </span>


                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-600 transition duration-500 group-hover:scale-110 dark:bg-cyan-950/40 dark:text-cyan-400"
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
                                    d="M12 3v18M3 12h18"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                            </svg>

                        </div>

                    </div>


                    <h3 class="mt-8 text-lg font-bold text-slate-900 dark:text-white">
                        Registra tu equipo
                    </h3>


                    <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Tu dispositivo queda identificado junto con la información
                        necesaria para su reparación.
                    </p>

                </article>



                {{-- PASO 2 --}}

                <article
                    class="group relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-7 transition duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-cyan-950/5 dark:border-slate-800 dark:bg-slate-900"
                >

                    <div class="flex items-center justify-between">

                        <span
                            class="text-5xl font-black text-slate-100 transition duration-500 group-hover:text-cyan-100 dark:text-slate-800 dark:group-hover:text-cyan-950"
                        >
                            02
                        </span>


                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition duration-500 group-hover:scale-110 dark:bg-blue-950/40 dark:text-blue-400"
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
                                    d="M14.7 6.3a4.5 4.5 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4.5 4.5 0 0 0 5.4-5.4l-2.5 2.5-2.8-.7-.7-2.8 2.5-2.5Z"
                                />
                            </svg>

                        </div>

                    </div>


                    <h3 class="mt-8 text-lg font-bold text-slate-900 dark:text-white">
                        Sigue la reparación
                    </h3>


                    <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Consulta el estado de tu equipo y mantente informado
                        sobre el avance del servicio.
                    </p>

                </article>



                {{-- PASO 3 --}}

                <article
                    class="group relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-7 transition duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-cyan-950/5 dark:border-slate-800 dark:bg-slate-900"
                >

                    <div class="flex items-center justify-between">

                        <span
                            class="text-5xl font-black text-slate-100 transition duration-500 group-hover:text-cyan-100 dark:text-slate-800 dark:group-hover:text-cyan-950"
                        >
                            03
                        </span>


                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition duration-500 group-hover:scale-110 dark:bg-emerald-950/40 dark:text-emerald-400"
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
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>

                        </div>

                    </div>


                    <h3 class="mt-8 text-lg font-bold text-slate-900 dark:text-white">
                        Recibe tu equipo
                    </h3>


                    <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Cuando tu reparación esté lista, tendrás la información
                        necesaria para continuar con el proceso.
                    </p>

                </article>

            </div>

        </section>



        {{-- =========================================================
            SECCIÓN DE CONFIANZA
        ========================================================== --}}

        <section
            class="relative overflow-hidden border-y border-slate-200 bg-slate-950 text-white dark:border-slate-800"
        >

            {{-- Glow --}}

            <div
                class="pulse-glow absolute -left-40 top-1/2 h-96 w-96 -translate-y-1/2 rounded-full bg-cyan-500/10 blur-[100px]"
            ></div>


            <div
                class="pulse-glow absolute -right-40 top-1/2 h-96 w-96 -translate-y-1/2 rounded-full bg-blue-500/10 blur-[100px]"
            ></div>


            <div
                class="relative mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-28"
            >

                <div class="grid items-center gap-14 lg:grid-cols-2">


                    {{-- TEXTO --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-[.2em] text-cyan-400">
                            Tecnología para tu tranquilidad
                        </p>


                        <h2
                            class="mt-5 text-3xl font-black tracking-tight sm:text-4xl"
                        >
                            Saber qué está pasando con tu equipo también es parte de una buena reparación.
                        </h2>


                        <p class="mt-6 max-w-xl leading-7 text-slate-400">
                            Delta System facilita la comunicación y el seguimiento
                            durante el proceso de reparación, para que tengas
                            la información de tu servicio cuando la necesites.
                        </p>


                        <div class="mt-8 flex flex-wrap gap-3">

                            <div
                                class="rounded-full border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-300"
                            >
                                Reparaciones
                            </div>

                            <div
                                class="rounded-full border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-300"
                            >
                                Equipos
                            </div>

                            <div
                                class="rounded-full border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-300"
                            >
                                Seguimiento
                            </div>

                            <div
                                class="rounded-full border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-300"
                            >
                                Clientes
                            </div>

                        </div>

                    </div>



                    {{-- VISUAL CIRCUITO --}}

                    <div class="relative mx-auto w-full max-w-md">


                        <div
                            class="relative overflow-hidden rounded-[2rem] border border-slate-800 bg-slate-900 p-6 shadow-2xl"
                        >

                            {{-- Scan line --}}

                            <div
                                class="pointer-events-none absolute left-0 right-0 h-20 bg-gradient-to-b from-transparent via-cyan-400/5 to-transparent"
                                style="animation: scan 5s linear infinite;"
                            ></div>


                            <div class="flex items-center justify-between">

                                <span class="text-xs font-bold tracking-widest text-slate-500">
                                    REPAIR STATUS
                                </span>

                                <span
                                    class="blink flex items-center gap-2 text-xs font-semibold text-emerald-400"
                                >

                                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                                    ACTIVE

                                </span>

                            </div>


                            {{-- Circuito --}}

                            <div class="relative mt-8 h-64">

                                <svg
                                    viewBox="0 0 400 220"
                                    class="h-full w-full"
                                    fill="none"
                                >

                                    <path
                                        d="M40 110 H105 V55 H180 V110 H260 V165 H350"
                                        stroke="currentColor"
                                        class="text-cyan-500/30"
                                        stroke-width="2"
                                    />

                                    <path
                                        d="M40 110 H105 V55 H180 V110 H260 V165 H350"
                                        stroke="currentColor"
                                        class="text-cyan-400"
                                        stroke-width="2"
                                        stroke-dasharray="10 12"
                                        style="animation: circuit 8s linear infinite;"
                                    />

                                    <circle
                                        cx="40"
                                        cy="110"
                                        r="7"
                                        class="fill-cyan-400"
                                    />

                                    <circle
                                        cx="105"
                                        cy="55"
                                        r="7"
                                        class="fill-blue-400"
                                    />

                                    <circle
                                        cx="180"
                                        cy="110"
                                        r="7"
                                        class="fill-cyan-400"
                                    />

                                    <circle
                                        cx="260"
                                        cy="165"
                                        r="7"
                                        class="fill-blue-400"
                                    />

                                    <circle
                                        cx="350"
                                        cy="165"
                                        r="7"
                                        class="fill-emerald-400"
                                    />

                                </svg>


                                {{-- Centro teléfono --}}

                                <div
                                    class="float-slow absolute left-1/2 top-1/2 flex h-28 w-16 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-[1.2rem] border-2 border-slate-700 bg-slate-950 shadow-2xl shadow-cyan-500/10"
                                >

                                    <div
                                        class="h-20 w-11 rounded-lg border border-slate-700 bg-gradient-to-b from-slate-800 to-slate-950"
                                    >

                                        <div
                                            class="mx-auto mt-2 h-1 w-4 rounded-full bg-slate-600"
                                        ></div>


                                        <div
                                            class="mx-auto mt-5 flex h-8 w-8 items-center justify-center rounded-full bg-cyan-500/10 text-cyan-400"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.6"
                                                stroke="currentColor"
                                                class="h-4 w-4"
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


                            <div class="grid grid-cols-2 gap-3">

                                <div class="rounded-2xl bg-slate-950 p-4">

                                    <p class="text-[10px] text-slate-500">
                                        Estado
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-cyan-400">
                                        En proceso
                                    </p>

                                </div>


                                <div class="rounded-2xl bg-slate-950 p-4">

                                    <p class="text-[10px] text-slate-500">
                                        Seguimiento
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-emerald-400">
                                        Disponible
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- =========================================================
            CTA FINAL
        ========================================================== --}}

        <section class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

            <div
                class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 px-7 py-16 text-center shadow-2xl shadow-slate-950/20 sm:px-12 lg:px-20"
            >

                {{-- Decoración --}}

                <div
                    class="absolute left-1/2 top-0 h-64 w-64 -translate-x-1/2 -translate-y-1/2 rounded-full bg-cyan-500/15 blur-[90px]"
                ></div>


                <div
                    class="absolute bottom-0 left-0 h-40 w-40 rounded-full bg-blue-500/10 blur-[70px]"
                ></div>


                <div
                    class="absolute bottom-0 right-0 h-40 w-40 rounded-full bg-cyan-500/10 blur-[70px]"
                ></div>


                <div class="relative">


                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-cyan-400/20 bg-cyan-400/10 text-cyan-400"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.7"
                            stroke="currentColor"
                            class="h-7 w-7"
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


                    <h2
                        class="mx-auto mt-7 max-w-2xl text-3xl font-black tracking-tight text-white sm:text-4xl"
                    >
                        Tu equipo merece algo más que una reparación.
                    </h2>


                    <p
                        class="mx-auto mt-5 max-w-xl text-sm leading-7 text-slate-400"
                    >
                        Merece un proceso claro, información accesible
                        y la tranquilidad de saber qué está pasando.
                    </p>


                    <div class="mt-8">

                        @guest

                            <a
                                href="{{ route('register') }}"
                                class="group inline-flex items-center gap-3 rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-slate-950 transition duration-300 hover:-translate-y-1 hover:bg-cyan-50"
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

                            </a>

                        @else

                            <a
                                href="{{ url('/dashboard') }}"
                                class="group inline-flex items-center gap-3 rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-slate-950 transition duration-300 hover:-translate-y-1 hover:bg-cyan-50"
                            >

                                Ir a mi cuenta

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

                            </a>

                        @endguest

                    </div>

                </div>

            </div>

        </section>

    </main>



    {{-- =========================================================
        FOOTER
    ========================================================== --}}

    <footer class="border-t border-slate-200 dark:border-slate-800">

        <div
            class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-slate-400 sm:flex-row lg:px-8"
        >

            <div class="flex items-center gap-2">

                <div
                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-950 text-white dark:bg-white dark:text-slate-950"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3 4 18h16L12 3Z"
                        />
                    </svg>

                </div>

                <span class="font-medium">
                    Delta System
                </span>

            </div>


            <p>
                © {{ date('Y') }} Delta System. Todos los derechos reservados.
            </p>


            <p class="hidden sm:block">
                Tecnología para reparaciones.
            </p>

        </div>

    </footer>



    {{-- =========================================================
        DARK MODE
    ========================================================== --}}

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

            const prefersDark =
                window.matchMedia(
                    '(prefers-color-scheme: dark)'
                ).matches;

            applyTheme(
                prefersDark ? 'dark' : 'light'
            );

        }


        themeToggle.addEventListener('click', function () {

            const isDark =
                document.documentElement.classList.contains('dark');

            applyTheme(
                isDark ? 'light' : 'dark'
            );

        });

    </script>

</body>

</html>