<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8 dark:bg-slate-950">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- ENCABEZADO --}}
            <div class="mb-8">
                <a
                    href="{{ route('categories.index') }}"
                    class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-cyan-600 dark:text-slate-400 dark:hover:text-cyan-400"
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
                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                        />
                    </svg>

                    Regresar a categorías
                </a>

                <p class="mb-1 text-sm font-semibold uppercase tracking-wider text-cyan-600 dark:text-cyan-400">
                    Inventario
                </p>

                <h1 class="text-2xl font-bold text-slate-900 dark:text-white sm:text-3xl">
                    Agregar categoría
                </h1>

                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                    Registra una nueva categoría para organizar los productos del inventario.
                </p>
            </div>

            {{-- ERRORES --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-950/30">
                    <div class="flex gap-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0 text-red-600 dark:text-red-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0 3h.008M10.29 3.86 2.82 17.25A1.875 1.875 0 0 0 4.45 20h15.1a1.875 1.875 0 0 0 1.63-2.75L13.71 3.86a1.875 1.875 0 0 0-3.42 0Z"
                            />
                        </svg>

                        <div>
                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Revisa los siguientes campos:
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- FORMULARIO --}}
            <form
                action="{{ route('categories.store') }}"
                method="POST"
                x-data="{ tipo: '{{ old('tipo', 'padre') }}' }"
                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
            >
                @csrf

                {{-- DATOS --}}
                <div class="border-b border-slate-200 px-6 py-6 dark:border-slate-800 sm:px-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
                            Datos de la categoría
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Define el nombre y la estructura de la categoría.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-6">

                        {{-- NOMBRE --}}
                        <div>
                            <label
                                for="nombre"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                Nombre
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="nombre"
                                name="nombre"
                                type="text"
                                value="{{ old('nombre') }}"
                                placeholder="Ej. Pantallas"
                                required
                                autofocus
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                            >
                        </div>

                        {{-- TIPO --}}
                        <div>
                            <label
                                for="tipo"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                Tipo de categoría
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="tipo"
                                name="tipo"
                                x-model="tipo"
                                required
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                            >
                                <option value="padre">Padre</option>
                                <option value="hija">Hija</option>
                            </select>

                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                Una categoría hija debe pertenecer a una categoría padre.
                            </p>
                        </div>

                        {{-- CATEGORÍA PADRE --}}
                        <div
                            x-show="tipo === 'hija'"
                            x-transition
                            x-cloak
                        >
                            <label
                                for="categoria_padre_id"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                Categoría padre
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="categoria_padre_id"
                                name="categoria_padre_id"
                                :required="tipo === 'hija'"
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                            >
                                <option value="">Selecciona una categoría padre</option>

                                @foreach ($parentCategories as $parentCategory)
                                    <option
                                        value="{{ $parentCategory->id }}"
                                        @selected(old('categoria_padre_id') == $parentCategory->id)
                                    >
                                        {{ $parentCategory->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($parentCategories->isEmpty())
                                <p class="mt-2 text-xs text-amber-600 dark:text-amber-400">
                                    Primero debes crear al menos una categoría padre.
                                </p>
                            @endif
                        </div>

                    </div>
                </div>

                {{-- BOTONES --}}
                <div class="flex flex-col-reverse gap-3 bg-slate-50 px-6 py-5 dark:bg-slate-950/50 sm:flex-row sm:justify-end sm:px-8">
                    <a
                        href="{{ route('categories.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:bg-cyan-500 dark:hover:bg-cyan-400 dark:focus:ring-offset-slate-900"
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
                                d="M12 4.5v15m7.5-7.5h-15"
                            />
                        </svg>

                        Guardar categoría
                    </button>
                </div>
            </form>

        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-app-layout>