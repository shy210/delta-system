<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <a
                        href="{{ route('categories.index') }}"
                        class="mb-3 inline-flex items-center gap-2 text-sm font-medium text-slate-600 transition hover:text-cyan-600 dark:text-slate-400 dark:hover:text-cyan-400"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7"/>
                        </svg>

                        Volver a categorías
                    </a>

                    <p class="text-sm font-semibold uppercase tracking-wider text-cyan-600 dark:text-cyan-400">
                        Inventario
                    </p>

                    <h1 class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">
                        Detalle de categoría
                    </h1>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Consulta la información registrada de esta categoría.
                    </p>
                </div>

                <a
                    href="{{ route('categories.edit', $category) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5h6m-6 0v6m0-6l8 8m-8-8L5 11m6-6H5a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-6"/>
                    </svg>

                    Editar categoría
                </a>
            </div>

            {{-- Información principal --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
                        Información general
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Datos principales de la categoría.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">

                    {{-- Nombre --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Nombre
                        </p>

                        <p class="mt-2 text-base font-semibold text-slate-900 dark:text-white">
                            {{ $category->nombre }}
                        </p>
                    </div>

                    {{-- Tipo --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Tipo
                        </p>

                        <div class="mt-2">
                            @if ($category->tipo === 'padre')
                                <span class="inline-flex rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300">
                                    Padre
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                    Hija
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Categoría padre --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Categoría padre
                        </p>

                        <p class="mt-2 text-base text-slate-900 dark:text-white">
                            {{ $category->categoriaPadre?->nombre ?? 'Sin categoría padre' }}
                        </p>
                    </div>

                    {{-- Fecha de registro --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Fecha de registro
                        </p>

                        <p class="mt-2 text-base text-slate-900 dark:text-white">
                            {{ $category->created_at?->format('d/m/Y H:i') ?? '—' }}
                        </p>
                    </div>

                    {{-- Última actualización --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Última actualización
                        </p>

                        <p class="mt-2 text-base text-slate-900 dark:text-white">
                            {{ $category->updated_at?->format('d/m/Y H:i') ?? '—' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Subcategorías --}}
            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
                        Subcategorías
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Categorías hijas relacionadas con esta categoría.
                    </p>
                </div>

                @if ($category->subcategorias->count())
                    <div class="divide-y divide-slate-200 dark:divide-slate-800">

                        @foreach ($category->subcategorias as $subcategoria)
                            <div class="flex flex-col gap-3 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white">
                                        {{ $subcategoria->nombre }}
                                    </p>

                                    <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Categoría hija
                                    </p>
                                </div>

                                <a
                                    href="{{ route('categories.show', $subcategoria) }}"
                                    class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-cyan-600 hover:text-cyan-700 dark:text-cyan-400 dark:hover:text-cyan-300"
                                >
                                    Ver categoría

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="px-6 py-10 text-center">
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Esta categoría no tiene subcategorías registradas.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Acciones --}}
            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('categories.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
                >
                    Volver
                </a>

                <a
                    href="{{ route('categories.edit', $category) }}"
                    class="inline-flex items-center justify-center rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-700"
                >
                    Editar categoría
                </a>

            </div>

        </div>
    </div>
</x-app-layout>