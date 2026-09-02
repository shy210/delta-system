<x-app-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 transition-colors duration-300 dark:bg-slate-950 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-5xl">

            {{-- Encabezado --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm font-semibold text-slate-500 dark:text-slate-400">
                        <span class="h-2 w-2 rounded-full bg-slate-900 dark:bg-white"></span>
                        Administración
                    </div>

                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        Detalles de la sucursal
                    </h1>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Consulta la información registrada de esta sucursal.
                    </p>
                </div>

                <a
                    href="{{ route('branches.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                >
                    ← Volver a sucursales
                </a>

            </div>

            {{-- Contenido --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                {{-- Logo --}}
                <div class="relative flex h-64 items-center justify-center overflow-hidden bg-slate-100 dark:bg-slate-800">

                    <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-slate-200 opacity-70 blur-3xl dark:bg-slate-700"></div>

                    <div class="absolute -bottom-16 -left-16 h-40 w-40 rounded-full bg-slate-200 opacity-70 blur-3xl dark:bg-slate-700"></div>

                    @if($branch->logo)

                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($branch->logo) }}"
                            alt="Logo de {{ $branch->nombre }}"
                            class="relative h-52 w-52 object-contain"
                        >

                    @else

                        <div class="relative flex h-32 w-32 items-center justify-center rounded-2xl bg-white text-5xl font-extrabold text-slate-400 shadow-sm dark:bg-slate-700 dark:text-slate-300">
                            {{ strtoupper(substr($branch->nombre, 0, 1)) }}
                        </div>

                    @endif

                </div>

                {{-- Información --}}
                <div class="p-6 sm:p-8">

                    <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ $branch->nombre }}
                            </h2>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ $branch->municipio }}, {{ $branch->estado }}
                            </p>
                        </div>

                        <span class="inline-flex w-fit items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                            Activa
                        </span>

                    </div>

                    {{-- Datos generales --}}
                    <div class="grid gap-6 border-t border-slate-200 pt-6 dark:border-slate-800 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                País
                            </p>

                            <p class="mt-1 text-sm font-medium text-slate-800 dark:text-slate-200">
                                {{ $branch->pais }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Moneda
                            </p>

                            <p class="mt-1 text-sm font-medium text-slate-800 dark:text-slate-200">
                                {{ $branch->moneda }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Teléfono
                            </p>

                            <p class="mt-1 text-sm font-medium text-slate-800 dark:text-slate-200">
                                {{ $branch->telefono }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Código postal
                            </p>

                            <p class="mt-1 text-sm font-medium text-slate-800 dark:text-slate-200">
                                {{ $branch->codigo_postal }}
                            </p>
                        </div>

                    </div>

                    {{-- Descripción --}}
                    @if($branch->descripcion)

                        <div class="mt-8 border-t border-slate-200 pt-6 dark:border-slate-800">

                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Descripción
                            </p>

                            <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                {{ $branch->descripcion }}
                            </p>

                        </div>

                    @endif

                    {{-- Dirección --}}
                    <div class="mt-8 border-t border-slate-200 pt-6 dark:border-slate-800">

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Dirección
                        </p>

                        <p class="mt-2 text-sm leading-6 text-slate-700 dark:text-slate-300">

                            {{ $branch->calle }}
                            #{{ $branch->numero_exterior }}

                            @if($branch->numero_interior)
                                Int. {{ $branch->numero_interior }}
                            @endif

                            <br>

                            {{ $branch->colonia }},
                            {{ $branch->municipio }},
                            {{ $branch->estado }}

                            <br>

                            C.P. {{ $branch->codigo_postal }},
                            {{ $branch->pais }}

                        </p>

                    </div>

                    {{-- Acciones --}}
                    @if(auth()->user()->role === 'admin')

                        <div class="mt-8 flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row dark:border-slate-800">

                            <a
                                href="{{ route('branches.edit', $branch) }}"
                                class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                            >
                                Editar sucursal
                            </a>

                            <form
                                action="{{ route('branches.destroy', $branch) }}"
                                method="POST"
                                onsubmit="return confirm('¿Estás segura de que deseas eliminar esta sucursal? Esta acción no se puede deshacer.');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100 sm:w-auto dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-400 dark:hover:bg-red-950/50"
                                >
                                    Eliminar sucursal
                                </button>
                            </form>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>