<x-app-layout>


<div class="min-h-screen bg-slate-50 px-4 py-6 transition-colors duration-300 dark:bg-slate-950 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-7xl">

        {{-- HERO --}}
        <section class="relative overflow-hidden rounded-3xl bg-slate-950 px-6 py-8 shadow-xl sm:px-8 lg:px-10">

            {{-- Decorative glow --}}
            <div class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-cyan-500/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-blue-500/10 blur-3xl"></div>

            {{-- Circuit decoration --}}
            <div class="pointer-events-none absolute right-8 top-8 hidden opacity-20 sm:block">
                <svg width="180" height="140" viewBox="0 0 180 140" fill="none">
                    <path d="M10 30H55V60H95V20H145" stroke="currentColor" stroke-width="1"/>
                    <path d="M40 110H80V80H125V115H170" stroke="currentColor" stroke-width="1"/>
                    <circle cx="55" cy="30" r="4" fill="currentColor"/>
                    <circle cx="95" cy="60" r="4" fill="currentColor"/>
                    <circle cx="145" cy="20" r="4" fill="currentColor"/>
                    <circle cx="80" cy="110" r="4" fill="currentColor"/>
                    <circle cx="125" cy="80" r="4" fill="currentColor"/>
                </svg>
            </div>

            <div class="relative">

                <div class="mb-5 flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-400/10 text-cyan-400">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 5h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 9h6v6H9z"/>
                        </svg>
                    </span>

                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-400">
                        Delta System
                    </span>
                </div>

                <h1 class="max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Hola, {{ Auth::user()->name }} 
                </h1>

                <p class="mt-3 max-w-xl text-sm leading-6 text-slate-400 sm:text-base">
                    Bienvenido al panel de administración.
                    Desde aquí puedes supervisar y gestionar la operación de Delta System.
                </p>

                <div class="mt-7 flex flex-wrap gap-3">

                    <a href="{{ route('customers.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-cyan-400 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300 hover:shadow-lg hover:shadow-cyan-500/20">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-9a4 4 0 110 8 4 4 0 010-8zm6 1a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>

                        Ver clientes
                    </a>

                    <a href="{{ route('branches.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-white/5 px-4 py-2.5 text-sm font-semibold text-white transition hover:border-slate-600 hover:bg-white/10">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m-2 4h2m4-8h2m-2 4h2m-2 4h2"/>
                        </svg>

                        Ver sucursales
                    </a>

                </div>

            </div>
        </section>


        {{-- CONTENIDO PRINCIPAL --}}
        <div class="mt-8 grid gap-6 lg:grid-cols-3">

            {{-- ACCIONES --}}
            <section class="lg:col-span-1">

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-colors duration-300 dark:border-slate-800 dark:bg-slate-900">

                    <div class="mb-6">
                        <p class="text-xs font-semibold uppercase tracking-wider text-cyan-500">
                            Administración
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                            Acciones rápidas
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Accede rápidamente a las principales herramientas.
                        </p>
                    </div>

                    <div class="space-y-3">

                        {{-- Clientes --}}
                        <a href="{{ route('customers.index') }}"
                           class="group flex items-center gap-4 rounded-2xl border border-slate-200 p-4 transition duration-200 hover:-translate-y-0.5 hover:border-cyan-300 hover:bg-cyan-50 dark:border-slate-800 dark:hover:border-cyan-800 dark:hover:bg-cyan-950/30">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-cyan-100 text-cyan-600 dark:bg-cyan-500/10 dark:text-cyan-400">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                                </svg>

                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-slate-900 dark:text-white">
                                    Clientes
                                </p>

                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    Consultar y gestionar clientes
                                </p>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-4 w-4 text-slate-400 transition group-hover:translate-x-1 group-hover:text-cyan-500"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>

                        </a>


                        {{-- Sucursales --}}
                        <a href="{{ route('branches.index') }}"
                           class="group flex items-center gap-4 rounded-2xl border border-slate-200 p-4 transition duration-200 hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50 dark:border-slate-800 dark:hover:border-blue-800 dark:hover:bg-blue-950/30">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m-2 4h2m4-8h2m-2 4h2m-2 4h2"/>
                                </svg>

                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-slate-900 dark:text-white">
                                    Sucursales
                                </p>

                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    Administrar puntos de servicio
                                </p>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-4 w-4 text-slate-400 transition group-hover:translate-x-1 group-hover:text-blue-500"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>

                        </a>


                        {{-- Próximamente --}}
                        <div class="flex items-center gap-4 rounded-2xl border border-dashed border-slate-200 p-4 dark:border-slate-800">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                </svg>

                            </div>

                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-300">
                                    Más módulos
                                </p>

                                <p class="text-xs text-slate-400">
                                    Próximamente
                                </p>
                            </div>

                        </div>

                    </div>
                </div>

            </section>


            {{-- CLIENTES RECIENTES --}}
            <section class="lg:col-span-2">

                <div class="h-full rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-colors duration-300 dark:border-slate-800 dark:bg-slate-900">

                    <div class="mb-6 flex items-start justify-between gap-4">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-500">
                                Actividad
                            </p>

                            <h2 class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                Clientes recientes
                            </h2>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Los últimos clientes registrados en el sistema.
                            </p>
                        </div>

                        <a href="{{ route('customers.index') }}"
                           class="hidden rounded-lg px-3 py-2 text-xs font-semibold text-cyan-600 transition hover:bg-cyan-50 sm:block dark:text-cyan-400 dark:hover:bg-cyan-950/30">
                            Ver todos
                        </a>

                    </div>


                    @if($clientesRecientes->count())

                        <div class="space-y-2">

                            @foreach($clientesRecientes as $cliente)

                                <div class="group flex items-center gap-4 rounded-2xl p-3 transition hover:bg-slate-50 dark:hover:bg-slate-800/60">

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 text-sm font-bold text-white shadow-sm">
                                        {{ strtoupper(substr($cliente->nombre ?? 'C', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">
                                            {{ $cliente->nombre }}
                                            {{ $cliente->apellido_paterno ?? '' }}
                                        </p>

                                        <p class="truncate text-xs text-slate-500 dark:text-slate-400">
                                            {{ $cliente->correo ?? 'Sin correo registrado' }}
                                        </p>

                                    </div>

                                    <div class="hidden text-right sm:block">
                                        <p class="text-xs text-slate-400 dark:text-slate-500">
                                            Registrado
                                        </p>

                                        <p class="text-xs font-medium text-slate-600 dark:text-slate-300">
                                            {{ $cliente->created_at?->format('d/m/Y') }}
                                        </p>
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="flex min-h-48 flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 text-center dark:border-slate-800">

                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400 dark:bg-slate-800">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-6 w-6"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8z"/>
                                </svg>

                            </div>

                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                Aún no hay clientes registrados
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Los nuevos registros aparecerán aquí.
                            </p>

                        </div>

                    @endif

                </div>

            </section>

        </div>


        {{-- SUCURSALES --}}
        <section class="mt-6">

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-colors duration-300 dark:border-slate-800 dark:bg-slate-900">

                <div class="mb-6 flex items-start justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-blue-500">
                            Operación
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                            Sucursales
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Vista general de los puntos de servicio registrados.
                        </p>
                    </div>

                    <a href="{{ route('branches.index') }}"
                       class="rounded-lg px-3 py-2 text-xs font-semibold text-blue-600 transition hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-950/30">
                        Ver todas
                    </a>

                </div>


                @if($sucursalesRecientes->count())

                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

                        @foreach($sucursalesRecientes as $sucursal)

                            <div class="group rounded-2xl border border-slate-200 p-4 transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-md dark:border-slate-800 dark:hover:border-blue-900">

                                <div class="mb-4 flex items-center justify-between">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-5 w-5"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m-2 4h2m4-8h2m-2 4h2m-2 4h2"/>
                                        </svg>

                                    </div>

                                    <span class="h-2 w-2 rounded-full bg-cyan-400 shadow-sm shadow-cyan-400/50"></span>

                                </div>

                                <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ $sucursal->nombre }}
                                </p>

                                <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                    {{ $sucursal->municipio ?? 'Ubicación no registrada' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center dark:border-slate-800">

                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                            Aún no hay sucursales registradas
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Las sucursales aparecerán aquí cuando sean agregadas.
                        </p>

                    </div>

                @endif

            </div>

        </section>

    </div>

</div>

</x-app-layout>
