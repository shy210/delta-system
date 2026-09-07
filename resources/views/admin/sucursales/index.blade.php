<x-app-layout>


<div class="min-h-screen bg-slate-50 px-4 py-6 transition-colors duration-300 dark:bg-slate-950 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-7xl">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="mb-3 flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-cyan-400 shadow-sm shadow-cyan-400/50"></span>

                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-600 dark:text-cyan-400">
                        Operación
                    </span>
                </div>

                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                    Sucursales
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                    Administra los puntos de servicio donde Delta System lleva el control de las reparaciones.
                </p>

            </div>


            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('branches.create') }}"
                    class="group inline-flex items-center justify-center gap-2 rounded-xl bg-slate-950 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-slate-950/10 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-100"
                >

                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-cyan-400 text-slate-950 transition group-hover:rotate-90">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3.5 w-3.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                    </span>

                    Nueva sucursal

                </a>

            @endif

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="mb-8 flex items-start gap-3 rounded-2xl border border-cyan-200 bg-cyan-50 px-5 py-4 text-cyan-900 dark:border-cyan-900/50 dark:bg-cyan-950/30 dark:text-cyan-300">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-cyan-100 text-cyan-600 dark:bg-cyan-500/10 dark:text-cyan-400">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-sm font-bold">
                        Operación completada
                    </p>

                    <p class="mt-0.5 text-sm opacity-80">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- BRANCHES --}}
        @if($branches->count() > 0)

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

                @foreach($branches as $branch)

                    <article
                        class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-cyan-200 hover:shadow-xl hover:shadow-slate-200/60 dark:border-slate-800 dark:bg-slate-900 dark:hover:border-cyan-900 dark:hover:shadow-black/20"
                    >

                        {{-- LOGO --}}
                        <div class="relative flex h-52 items-center justify-center overflow-hidden bg-slate-100 dark:bg-slate-800">

                            {{-- Decorative background --}}
                            <div class="absolute inset-0 opacity-40">

                                <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-cyan-300/20 blur-3xl transition duration-500 group-hover:bg-cyan-400/30"></div>

                                <div class="absolute -bottom-16 -left-16 h-40 w-40 rounded-full bg-blue-400/10 blur-3xl transition duration-500 group-hover:bg-blue-400/20"></div>

                            </div>


                            {{-- Circuit decoration --}}
                            <div class="pointer-events-none absolute right-4 top-4 opacity-10 transition duration-500 group-hover:opacity-20">

                                <svg
                                    width="110"
                                    height="80"
                                    viewBox="0 0 110 80"
                                    fill="none"
                                >
                                    <path
                                        d="M5 20H35V45H65V15H105"
                                        stroke="currentColor"
                                        stroke-width="1"
                                    />

                                    <path
                                        d="M20 70H50V55H85V70H105"
                                        stroke="currentColor"
                                        stroke-width="1"
                                    />

                                    <circle cx="35" cy="20" r="3" fill="currentColor"/>
                                    <circle cx="65" cy="45" r="3" fill="currentColor"/>
                                    <circle cx="85" cy="55" r="3" fill="currentColor"/>

                                </svg>

                            </div>


                            @if($branch->logo)

                                <div class="relative flex h-36 w-36 items-center justify-center rounded-3xl bg-white p-4 shadow-lg transition duration-300 group-hover:scale-105 dark:bg-slate-700">

                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($branch->logo) }}"
                                        alt="Logo de {{ $branch->nombre }}"
                                        class="h-full w-full object-contain"
                                    >

                                </div>

                            @else

                                <div class="relative flex h-28 w-28 items-center justify-center rounded-3xl bg-white text-4xl font-extrabold text-slate-400 shadow-lg transition duration-300 group-hover:scale-105 dark:bg-slate-700 dark:text-slate-300">

                                    {{ strtoupper(substr($branch->nombre, 0, 1)) }}

                                </div>

                            @endif

                        </div>


                        {{-- CONTENT --}}
                        <div class="p-6">

                            {{-- Title --}}
                            <div class="mb-6">

                                <div class="flex items-start justify-between gap-3">

                                    <div class="min-w-0">

                                        <h2 class="truncate text-xl font-extrabold text-slate-900 dark:text-white">
                                            {{ $branch->nombre }}
                                        </h2>

                                        <div class="mt-2 flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 shrink-0 text-cyan-500"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 21s7-5.5 7-12a7 7 0 10-14 0c0 6.5 7 12 7 12z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="9"
                                                    r="2"
                                                    stroke-width="1.8"
                                                />
                                            </svg>

                                            <span class="truncate">
                                                {{ $branch->municipio }}, {{ $branch->estado }}
                                            </span>

                                        </div>

                                    </div>


                                    {{-- Status --}}
                                    <span class="flex shrink-0 items-center gap-1.5 rounded-full bg-cyan-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-cyan-700 dark:bg-cyan-950/40 dark:text-cyan-400">

                                        <span class="h-1.5 w-1.5 rounded-full bg-cyan-400 shadow-sm shadow-cyan-400/50"></span>

                                        Activa

                                    </span>

                                </div>

                            </div>


                            {{-- DATA --}}
                            <div class="space-y-3 border-t border-slate-100 pt-5 dark:border-slate-800">

                                <div class="flex items-center justify-between gap-4 text-sm">

                                    <span class="text-slate-500 dark:text-slate-400">
                                        País
                                    </span>

                                    <span class="truncate font-semibold text-slate-800 dark:text-slate-200">
                                        {{ $branch->pais }}
                                    </span>

                                </div>


                                <div class="flex items-center justify-between gap-4 text-sm">

                                    <span class="text-slate-500 dark:text-slate-400">
                                        Moneda
                                    </span>

                                    <span class="font-semibold text-slate-800 dark:text-slate-200">
                                        {{ $branch->moneda }}
                                    </span>

                                </div>


                                <div class="flex items-center justify-between gap-4 text-sm">

                                    <span class="text-slate-500 dark:text-slate-400">
                                        Teléfono
                                    </span>

                                    <span class="truncate font-semibold text-slate-800 dark:text-slate-200">
                                        {{ $branch->telefono }}
                                    </span>

                                </div>

                            </div>


                            {{-- ACTIONS --}}
                            <div class="mt-6 grid grid-cols-2 gap-3">

                                <a
                                    href="{{ route('branches.show', $branch) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-700 transition duration-200 hover:border-cyan-200 hover:bg-cyan-50 hover:text-cyan-700 dark:border-slate-700 dark:text-slate-300 dark:hover:border-cyan-900 dark:hover:bg-cyan-950/30 dark:hover:text-cyan-400"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />

                                    </svg>

                                    Ver detalles

                                </a>


                                @if(auth()->user()->role === 'admin')

                                    <a
                                        href="{{ route('branches.edit', $branch) }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-950 px-4 py-2.5 text-sm font-bold text-white transition duration-200 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-100"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 20h9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                            />

                                        </svg>

                                        Editar

                                    </a>


                                    <form
                                        action="{{ route('branches.destroy', $branch) }}"
                                        method="POST"
                                        class="col-span-2"
                                        onsubmit="return confirm('¿Estás segura de que deseas eliminar esta sucursal? Esta acción no se puede deshacer.');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="group flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-bold text-red-600 transition duration-200 hover:border-red-300 hover:bg-red-100 dark:border-red-900/50 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/40"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 transition group-hover:scale-110"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 6h18"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M8 6V4h8v2M19 6l-1 15H6L5 6"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M10 11v6M14 11v6"
                                                />

                                            </svg>

                                            Eliminar sucursal

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


        @else

            {{-- EMPTY STATE --}}
            <div class="relative overflow-hidden rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center shadow-sm dark:border-slate-700 dark:bg-slate-900">

                <div class="pointer-events-none absolute -right-20 -top-20 h-56 w-56 rounded-full bg-cyan-400/10 blur-3xl"></div>

                <div class="pointer-events-none absolute -bottom-20 -left-20 h-56 w-56 rounded-full bg-blue-400/10 blur-3xl"></div>


                <div class="relative">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-9 w-9"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 21h18M5 21V5l7-3 7 3v16M9 21v-4h6v4M9 9h1m4 0h1m-6 4h1m4 0h1"
                            />

                        </svg>

                    </div>


                    <h2 class="mt-6 text-xl font-extrabold text-slate-900 dark:text-white">
                        No hay sucursales todavía
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Registra la primera sucursal para comenzar a configurar los puntos de servicio de Delta System.
                    </p>


                    @if(auth()->user()->role === 'admin')

                        <a
                            href="{{ route('branches.create') }}"
                            class="mt-7 inline-flex items-center gap-2 rounded-xl bg-slate-950 px-5 py-3 text-sm font-bold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-950 dark:hover:bg-slate-100"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 5v14M5 12h14"
                                />

                            </svg>

                            Crear primera sucursal

                        </a>

                    @endif

                </div>

            </div>

        @endif

    </div>

</div>

</x-app-layout>
