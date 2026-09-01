<x-app-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 transition-colors duration-300 dark:bg-slate-950 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl">

            {{-- Encabezado --}}
            <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div class="mb-3 flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-slate-900 dark:bg-white"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                            Administración
                        </span>

                    </div>

                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Sucursales
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                        Consulta y administra las sucursales registradas en Delta System.
                    </p>

                </div>

                @if(auth()->user()->role === 'admin')

                    <a
                        href="{{ route('branches.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        Nueva sucursal

                    </a>

                @endif

            </div>


            {{-- Mensaje de éxito --}}
            @if(session('success'))

                <div class="mb-8 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

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


            {{-- Sucursales --}}
            @if($branches->count() > 0)

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

                    @foreach($branches as $branch)

                        <article
                            class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-800 dark:bg-slate-900"
                        >

                            {{-- Logo --}}
                            <div class="relative flex h-48 items-center justify-center overflow-hidden bg-slate-100 dark:bg-slate-800">

                                <div class="absolute -right-12 -top-12 h-32 w-32 rounded-full bg-slate-200 opacity-0 blur-3xl transition duration-500 group-hover:opacity-100 dark:bg-slate-700"></div>

                                <div class="absolute -bottom-12 -left-12 h-32 w-32 rounded-full bg-slate-200 opacity-0 blur-3xl transition duration-500 group-hover:opacity-100 dark:bg-slate-700"></div>

                                @if($branch->logo)

                                    <img
                                        src="{{ asset('storage/' . $branch->logo) }}"
                                        alt="Logo de {{ $branch->nombre }}"
                                        class="relative h-32 w-32 object-contain transition duration-300 group-hover:scale-105"
                                    >

                                @else

                                    <div class="relative flex h-24 w-24 items-center justify-center rounded-2xl bg-white text-3xl font-extrabold text-slate-400 shadow-sm dark:bg-slate-700 dark:text-slate-300">
                                        {{ strtoupper(substr($branch->nombre, 0, 1)) }}
                                    </div>

                                @endif

                            </div>


                            {{-- Información --}}
                            <div class="p-6">

                                <div class="mb-5">

                                    <div class="flex items-start justify-between gap-3">

                                        <div class="min-w-0">

                                            <h2 class="truncate text-xl font-extrabold text-slate-900 dark:text-white">
                                                {{ $branch->nombre }}
                                            </h2>

                                            <p class="mt-1 flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400">

                                                <svg
                                                    class="h-4 w-4 shrink-0"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M12 21s7-5.5 7-12a7 7 0 10-14 0c0 6.5 7 12 7 12z"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="9"
                                                        r="2"
                                                        stroke-width="1.8"
                                                    />
                                                </svg>

                                                {{ $branch->municipio }}, {{ $branch->estado }}

                                            </p>

                                        </div>

                                        <span class="shrink-0 rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400">
                                            Activa
                                        </span>

                                    </div>

                                </div>


                                {{-- Datos --}}
                                <div class="space-y-3 border-t border-slate-100 pt-4 dark:border-slate-800">

                                    <div class="flex items-center justify-between gap-4 text-sm">

                                        <span class="text-slate-500 dark:text-slate-400">
                                            País
                                        </span>

                                        <span class="font-semibold text-slate-800 dark:text-slate-200">
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


                                {{-- Acciones --}}
                                <div class="mt-6 flex gap-3">

                                    <a
                                        href="{{ route('branches.show', $branch) }}"
                                        class="flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-center text-sm font-bold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                                    >
                                        Ver detalles
                                    </a>

                                    @if(auth()->user()->role === 'admin')

                                        <a
                                            href="{{ route('branches.edit', $branch) }}"
                                            class="flex-1 rounded-xl bg-slate-900 px-4 py-2.5 text-center text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                                        >
                                            Editar
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                {{-- Estado vacío --}}
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">

                        <svg
                            class="h-9 w-9"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="M3 21h18M5 21V5l7-3 7 3v16M9 21v-4h6v4M9 9h1m4 0h1m-6 4h1m4 0h1"
                            />
                        </svg>

                    </div>

                    <h2 class="mt-6 text-xl font-extrabold text-slate-900 dark:text-white">
                        No hay sucursales todavía
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Registra la primera sucursal para comenzar a configurar Delta System.
                    </p>

                    @if(auth()->user()->role === 'admin')

                        <a
                            href="{{ route('branches.create') }}"
                            class="mt-7 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Crear primera sucursal

                        </a>

                    @endif

                </div>

            @endif

        </div>

    </div>

</x-app-layout>