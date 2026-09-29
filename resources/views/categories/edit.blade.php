<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-8">
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
                    Editar categoría
                </h1>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Modifica la información de la categoría seleccionada.
                </p>
            </div>

            {{-- Errores --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-950/30">
                    <div class="flex gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M10.29 3.86l-7.36 12.73A2 2 0 004.66 19h14.68a2 2 0 001.73-2.41L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>

                        <div>
                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Revisa los siguientes datos:
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

            {{-- Formulario --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
                        Información de la categoría
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Actualiza los campos que necesites.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('categories.update', $category) }}"
                    x-data="{
                        tipo: '{{ old('tipo', $category->tipo) }}'
                    }"
                    class="p-6"
                >
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        {{-- Nombre --}}
                        <div>
                            <label
                                for="nombre"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Nombre
                            </label>

                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                value="{{ old('nombre', $category->nombre) }}"
                                required
                                maxlength="255"
                                placeholder="Ej. Pantallas"
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-500"
                            >

                            @error('nombre')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tipo --}}
                        <div>
                            <label
                                for="tipo"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Tipo de categoría
                            </label>

                            <select
                                id="tipo"
                                name="tipo"
                                x-model="tipo"
                                required
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="padre">Padre</option>
                                <option value="hija">Hija</option>
                            </select>

                            @error('tipo')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Categoría padre --}}
                        <div
                            x-show="tipo === 'hija'"
                            x-cloak
                        >
                            <label
                                for="categoria_padre_id"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Categoría padre
                            </label>

                            <select
                                id="categoria_padre_id"
                                name="categoria_padre_id"
                                :required="tipo === 'hija'"
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="">
                                    Selecciona una categoría padre
                                </option>

                                @foreach ($parentCategories as $parent)
                                    <option
                                        value="{{ $parent->id }}"
                                        {{ old('categoria_padre_id', $category->categoria_padre_id) == $parent->id ? 'selected' : '' }}
                                    >
                                        {{ $parent->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @error('categoria_padre_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- Botones --}}
                    <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end dark:border-slate-800">

                        <a
                            href="{{ route('categories.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"/>
                            </svg>

                            Guardar cambios
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-app-layout>