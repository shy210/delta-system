<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-800 dark:text-white">
                    Agregar producto
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Registra un nuevo producto para administrar su inventario y precios.
                </p>
            </div>

            <a
                href="{{ route('products.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Regresar
            </a>
        </div>
    </x-slot>

    <div
        x-data="productForm()"
        x-init="init()"
        class="py-6 sm:py-8"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- ERRORES --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 dark:border-red-900/60 dark:bg-red-950/30">
                    <div class="flex gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-semibold text-red-800 dark:text-red-300">
                                Revisa la información ingresada
                            </h3>

                            <ul class="mt-1 list-disc space-y-1 pl-5 text-sm text-red-700 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif


            <form
                method="POST"
                action="{{ route('products.store') }}"
                class="space-y-6"
            >
                @csrf

                {{-- ============================================================
                    DATOS GENERALES
                ============================================================= --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">

                    <div class="border-b border-slate-200 px-5 py-5 sm:px-6 dark:border-slate-700">
                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-800 dark:text-white">
                                    Datos generales
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Información principal del producto.
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2 lg:grid-cols-3">

                        {{-- Nombre --}}
                        <div class="md:col-span-2">
                            <label for="nombre" class="form-label">
                                Nombre del producto
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="nombre"
                                name="nombre"
                                type="text"
                                value="{{ old('nombre') }}"
                                required
                                class="form-input"
                                placeholder="Ej. Pantalla LCD para iPhone 11"
                            />
                        </div>


                        {{-- Código --}}
                        <div>
                            <label for="codigo" class="form-label">
                                SKU / Código de barras
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="flex gap-2">
                                <input
                                    id="codigo"
                                    name="codigo"
                                    type="text"
                                    value="{{ old('codigo') }}"
                                    required
                                    class="form-input min-w-0 flex-1"
                                    placeholder="Código"
                                />

                                <button
                                    type="button"
                                    @click="generateCode()"
                                    class="flex h-[46px] w-[46px] shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-600 transition hover:bg-slate-100 hover:text-cyan-600 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600 dark:hover:text-cyan-400"
                                    title="Generar código"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 7V4h3M17 4h3v3M20 17v3h-3M7 20H4v-3M7 8h10v8H7z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>


                        {{-- Proveedor --}}
                        <div>
                            <label for="supplier_id" class="form-label">
                                Proveedor
                            </label>

                            <select
                                id="supplier_id"
                                name="supplier_id"
                                class="form-input"
                            >
                                <option value="">Seleccionar proveedor</option>

                                @foreach ($suppliers as $supplier)
                                    <option
                                        value="{{ $supplier->id }}"
                                        @selected(old('supplier_id') == $supplier->id)
                                    >
                                        {{ $supplier->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Categoría --}}
                        <div>
                            <label for="category_id" class="form-label">
                                Categoría
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                x-model="categoryId"
                                @change="filterSubcategories()"
                                class="form-input"
                            >
                                <option value="">
                                    Seleccionar categoría
                                </option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('category_id') == $category->id)
                                    >
                                        {{ $category->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Subcategoría --}}
                        <div>
                            <label for="subcategory_id" class="form-label">
                                Subcategoría
                            </label>

                            <select
                                id="subcategory_id"
                                name="subcategory_id"
                                x-model="subcategoryId"
                                class="form-input"
                            >
                                <option value="">
                                    Seleccionar subcategoría
                                </option>

                                @foreach ($subcategories as $subcategory)
                                    <option
                                        value="{{ $subcategory->id }}"
                                        data-parent="{{ $subcategory->categoria_padre_id }}"
                                        @selected(old('subcategory_id') == $subcategory->id)
                                    >
                                        {{ $subcategory->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Descripción corta --}}
                        <div class="md:col-span-2">
                            <label for="descripcion_corta" class="form-label">
                                Descripción corta
                            </label>

                            <input
                                id="descripcion_corta"
                                name="descripcion_corta"
                                type="text"
                                value="{{ old('descripcion_corta') }}"
                                class="form-input"
                                placeholder="Descripción breve del producto"
                            />
                        </div>


                        {{-- Tipo de venta --}}
                        <div>
                            <label for="tipo_venta" class="form-label">
                                Tipo de venta
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="tipo_venta"
                                name="tipo_venta"
                                required
                                class="form-input"
                            >
                                <option
                                    value="unidad"
                                    @selected(old('tipo_venta', 'unidad') === 'unidad')
                                >
                                    Unidad
                                </option>

                                <option
                                    value="kilogramo"
                                    @selected(old('tipo_venta') === 'kilogramo')
                                >
                                    Kilogramo
                                </option>

                                <option
                                    value="metro"
                                    @selected(old('tipo_venta') === 'metro')
                                >
                                    Metro
                                </option>
                            </select>
                        </div>


                        {{-- Referencia --}}
                        <div>
                            <label for="referencia" class="form-label">
                                Referencia
                            </label>

                            <input
                                id="referencia"
                                name="referencia"
                                type="text"
                                value="{{ old('referencia') }}"
                                class="form-input"
                                placeholder="Modelo, referencia o código interno"
                            />
                        </div>


                        {{-- Locación --}}
                        <div>
                            <label for="sucursal_id" class="form-label">
                                Locación
                            </label>

                            <select
                                id="sucursal_id"
                                name="sucursal_id"
                                class="form-input"
                            >
                                <option value="">
                                    Seleccionar sucursal
                                </option>

                                @foreach ($branches as $branch)
                                    <option
                                        value="{{ $branch->id }}"
                                        @selected(old('sucursal_id') == $branch->id)
                                    >
                                        {{ $branch->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- APLICA DESCUENTO --}}
<div>
    <span class="form-label">
        ¿Aplica descuento?
    </span>

    <div
        class="flex min-h-[46px] items-center justify-between rounded-xl border px-4 transition
               border-slate-200 bg-slate-50
               dark:border-slate-600 dark:bg-slate-800"
    >

        <span
            class="text-sm font-medium"
            :class="aplicaDescuento
                ? 'text-cyan-700 dark:text-cyan-400'
                : 'text-slate-500 dark:text-slate-400'"
            x-text="aplicaDescuento ? 'Sí, aplica' : 'No aplica'"
        ></span>

        <button
            type="button"
            role="switch"
            :aria-checked="aplicaDescuento"
            @click="aplicaDescuento = !aplicaDescuento"
            class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800"
            :class="aplicaDescuento
                ? 'bg-cyan-600'
                : 'bg-slate-300 dark:bg-slate-600'"
        >
            <span
                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 ease-in-out"
                :class="aplicaDescuento
                    ? 'translate-x-5'
                    : 'translate-x-0'"
            ></span>
        </button>

        <input
            type="hidden"
            name="aplica_descuento"
            :value="aplicaDescuento ? 1 : 0"
        >

    </div>
</div>

                        {{-- Descripción larga --}}
                        <div class="md:col-span-2 lg:col-span-3">
                            <label for="descripcion_larga" class="form-label">
                                Descripción larga
                            </label>

                            <textarea
                                id="descripcion_larga"
                                name="descripcion_larga"
                                rows="4"
                                class="form-input resize-none"
                                placeholder="Agrega información detallada sobre el producto..."
                            >{{ old('descripcion_larga') }}</textarea>
                        </div>

                    </div>
                </section>


                {{-- ============================================================
                    INVENTARIO
                ============================================================= --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">

                    <div class="border-b border-slate-200 px-5 py-5 sm:px-6 dark:border-slate-700">
                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-100 text-violet-700 dark:bg-violet-900/40 dark:text-violet-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-800 dark:text-white">
                                    Inventario
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Define cómo se controlará la existencia del producto.
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="p-5 sm:p-6">

                        {{-- MANEJA SERIES --}}
<div
    class="rounded-2xl border p-4 transition
           border-slate-200 bg-slate-50
           dark:border-slate-600 dark:bg-slate-900/70"
>

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                ¿Maneja series?
            </p>

            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                Activa esta opción si cada unidad debe identificarse mediante una serie.
            </p>
        </div>


        <div class="flex items-center gap-3">

            <span
                class="text-sm font-medium"
                :class="manejaSeries
                    ? 'text-cyan-700 dark:text-cyan-400'
                    : 'text-slate-500 dark:text-slate-400'"
                x-text="manejaSeries ? 'Sí, maneja series' : 'No maneja series'"
            ></span>


            <button
                type="button"
                role="switch"
                :aria-checked="manejaSeries"
                @click="toggleSeries()"
                class="relative inline-flex h-7 w-12 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                :class="manejaSeries
                    ? 'bg-cyan-600'
                    : 'bg-slate-300 dark:bg-slate-600'"
            >

                <span
                    class="pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow transition duration-200 ease-in-out"
                    :class="manejaSeries
                        ? 'translate-x-5'
                        : 'translate-x-0'"
                ></span>

            </button>


            <input
                type="hidden"
                name="maneja_series"
                :value="manejaSeries ? 1 : 0"
            >

        </div>

    </div>
</div>
                        {{-- SERIES ACTIVADAS --}}
                        <div
                            x-show="manejaSeries"
                            x-cloak
                            x-transition
                            class="mt-5"
                        >

                            <div class="rounded-2xl border border-cyan-200 bg-cyan-50/70 p-4 dark:border-cyan-900/60 dark:bg-cyan-950/20">

                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                    <div>
                                        <h4 class="text-sm font-semibold text-slate-800 dark:text-white">
                                            Series del producto
                                        </h4>

                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            Registra las series y la sucursal donde se encuentran.
                                        </p>
                                    </div>

                                    <button
                                        type="button"
                                        @click="openSeriesForm()"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>

                                        Agregar serie
                                    </button>

                                </div>


                                {{-- FORMULARIO SERIE --}}
                                <div
                                    x-show="showSeriesForm"
                                    x-cloak
                                    x-transition
                                    class="mt-4 rounded-xl border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-800"
                                >

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                                        <div>
                                            <label class="form-label">
                                                Sucursal
                                            </label>

                                            <select
                                                x-model="newSeries.sucursal_id"
                                                class="form-input"
                                            >
                                                <option value="">
                                                    Seleccionar sucursal
                                                </option>

                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">
                                                        {{ $branch->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div>
                                            <label class="form-label">
                                                Número de serie
                                            </label>

                                            <div class="flex gap-2">

                                                <input
                                                    type="text"
                                                    x-model="newSeries.serie"
                                                    class="form-input min-w-0 flex-1"
                                                    placeholder="Ej. SN-2026-0001"
                                                >

                                                <button
                                                    type="button"
                                                    @click="generateSeries()"
                                                    class="flex h-[46px] w-[46px] shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-600 transition hover:bg-slate-100 hover:text-cyan-600 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600 dark:hover:text-cyan-400"
                                                    title="Generar serie"
                                                >
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 4v5h5M20 20v-5h-5M5.64 18.36A9 9 0 1018.36 5.64L20 7"
                                                        />
                                                    </svg>
                                                </button>

                                            </div>
                                        </div>

                                    </div>


                                    <div class="mt-4 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">

                                        <button
                                            type="button"
                                            @click="cancelSeriesForm()"
                                            class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700"
                                        >
                                            Cancelar
                                        </button>

                                        <button
                                            type="button"
                                            @click="addSeries()"
                                            class="rounded-xl bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-700"
                                        >
                                            Agregar
                                        </button>

                                    </div>

                                </div>


                                {{-- TABLA SERIES --}}
                                <div
                                    x-show="series.length > 0"
                                    x-cloak
                                    class="mt-5 overflow-hidden rounded-xl border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-800"
                                >

                                    <div class="overflow-x-auto">

                                        <table class="min-w-full text-left text-sm">

                                            <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-900/60 dark:text-slate-400">
                                                <tr>
                                                    <th class="px-4 py-3 font-semibold">
                                                        Sucursal
                                                    </th>

                                                    <th class="px-4 py-3 font-semibold">
                                                        Serie
                                                    </th>

                                                    <th class="px-4 py-3 text-right font-semibold">
                                                        Acción
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">

                                                <template
                                                    x-for="(item, index) in series"
                                                    :key="index"
                                                >
                                                    <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-700/40">

                                                        <td class="px-4 py-3 text-slate-700 dark:text-slate-200">
                                                            <span x-text="getBranchName(item.sucursal_id)"></span>

                                                            <input
                                                                type="hidden"
                                                                :name="`series[${index}][sucursal_id]`"
                                                                :value="item.sucursal_id"
                                                            >
                                                        </td>

                                                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">
                                                            <span x-text="item.serie"></span>

                                                            <input
                                                                type="hidden"
                                                                :name="`series[${index}][serie]`"
                                                                :value="item.serie"
                                                            >
                                                        </td>

                                                        <td class="px-4 py-3 text-right">
                                                            <button
                                                                type="button"
                                                                @click="removeSeries(index)"
                                                                class="text-sm font-semibold text-red-600 transition hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                                                            >
                                                                Quitar
                                                            </button>
                                                        </td>

                                                    </tr>
                                                </template>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>


                                {{-- SIN SERIES --}}
                                <div
                                    x-show="series.length === 0"
                                    x-cloak
                                    class="mt-5 rounded-xl border border-dashed border-slate-300 bg-white/70 px-4 py-8 text-center dark:border-slate-600 dark:bg-slate-800/60"
                                >
                                    <p class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                        Aún no has agregado ninguna serie.
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                        Agrega al menos una serie para guardar este producto.
                                    </p>
                                </div>

                            </div>
                        </div>


                        {{-- SIN SERIES --}}
                        <div
                            x-show="!manejaSeries"
                            x-cloak
                            x-transition
                            class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3"
                        >

                            <div>
                                <label for="stock_minimo" class="form-label">
                                    Existencia mínima
                                </label>

                                <input
                                    id="stock_minimo"
                                    name="stock_minimo"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('stock_minimo', 0) }}"
                                    class="form-input"
                                    placeholder="0"
                                />
                            </div>


                            <div>
                                <label for="stock_maximo" class="form-label">
                                    Existencia máxima
                                </label>

                                <input
                                    id="stock_maximo"
                                    name="stock_maximo"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('stock_maximo', 0) }}"
                                    class="form-input"
                                    placeholder="0"
                                />
                            </div>


                            <div>
                                <label for="stock" class="form-label">
                                    Existencia
                                </label>

                                <input
                                    id="stock"
                                    name="stock"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('stock', 0) }}"
                                    class="form-input"
                                    placeholder="0"
                                />
                            </div>

                        </div>

                    </div>
                </section>


                {{-- ============================================================
                    PRECIOS
                ============================================================= --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-800">

                    <div class="border-b border-slate-200 px-5 py-5 sm:px-6 dark:border-slate-700">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.12 3 2.5S13.657 18 12 18m0-10V6m0 12v-2m0-10a7 7 0 100 14 7 7 0 000-14z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-800 dark:text-white">
                                    Precios
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Configura el costo y los diferentes precios de venta.
                                </p>
                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        {{-- PRECIOS PRINCIPALES --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                            {{-- Precio compra --}}
                            <div>
                                <label for="costo_compra" class="form-label">
                                    Precio de compra
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm font-medium text-slate-400">
                                        $
                                    </span>

                                    <input
                                        id="costo_compra"
                                        name="costo_compra"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model.number="precioCompra"
                                        @input="calcularGanancia()"
                                        value="{{ old('costo_compra', 0) }}"
                                        required
                                        class="form-input pl-8"
                                        placeholder="0.00"
                                    />

                                </div>

                                <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">
                                    Costo que tiene el producto para el negocio.
                                </p>
                            </div>


                            {{-- Precio público --}}
                            <div>
                                <label for="precio_publico" class="form-label">
                                    Precio público
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm font-medium text-slate-400">
                                        $
                                    </span>

                                    <input
                                        id="precio_publico"
                                        name="precio_publico"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model.number="precioPublico"
                                        @input="calcularGanancia()"
                                        value="{{ old('precio_publico', 0) }}"
                                        required
                                        class="form-input pl-8"
                                        placeholder="0.00"
                                    />

                                </div>

                                <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">
                                    Precio de venta al cliente.
                                </p>
                            </div>


                            {{-- Ganancia --}}
                            <div>

                                <label for="ganancia_porcentaje" class="form-label">
                                    Ganancia
                                </label>

                                <div class="relative">

                                    <input
                                        id="ganancia_porcentaje"
                                        name="ganancia_porcentaje"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model="gananciaPorcentaje"
                                        readonly
                                        class="form-input cursor-not-allowed bg-slate-100 pr-9 dark:bg-slate-700/50"
                                        placeholder="0.00"
                                    />

                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                                        %
                                    </span>

                                </div>

                                <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">
                                    Se calcula automáticamente.
                                </p>

                            </div>

                        </div>


                        {{-- INDICADOR DE GANANCIA --}}
                        <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 dark:border-emerald-900/60 dark:bg-emerald-950/20">

                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                                <div>
                                    <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-300">
                                        Margen de ganancia
                                    </p>

                                    <p class="text-xs text-emerald-700/80 dark:text-emerald-400/80">
                                        Se actualiza automáticamente con base en el precio de compra y el precio público.
                                    </p>
                                </div>

                                <div class="text-left sm:text-right">
                                    <span
                                        class="text-2xl font-bold text-emerald-700 dark:text-emerald-300"
                                        x-text="gananciaPorcentaje + '%'"
                                    ></span>
                                </div>

                            </div>

                        </div>


                        {{-- PRECIOS ADICIONALES --}}
                        <div class="mt-7">

                            <div class="mb-4">
                                <h4 class="text-sm font-semibold text-slate-800 dark:text-white">
                                    Precios adicionales
                                </h4>

                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                    Configura precios alternativos para diferentes tipos de cliente.
                                </p>
                            </div>


                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">

                                @foreach ([
                                    2 => 'Precio 2',
                                    3 => 'Precio 3',
                                    4 => 'Precio 4',
                                    5 => 'Precio 5',
                                    6 => 'Precio 6',
                                ] as $number => $label)

                                    <div>

                                        <label
                                            for="precio_{{ $number }}"
                                            class="form-label"
                                        >
                                            {{ $label }}
                                        </label>

                                        <div class="relative">

                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-slate-400">
                                                $
                                            </span>

                                            <input
                                                id="precio_{{ $number }}"
                                                name="precio_{{ $number }}"
                                                type="number"
                                                step="0.01"
                                                min="0"
                                                value="{{ old('precio_' . $number) }}"
                                                class="form-input pl-8"
                                                placeholder="0.00"
                                            />

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>
                </section>


                {{-- ============================================================
                    BOTONES
                ============================================================= --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end dark:border-slate-700">

                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        Guardar producto
                    </button>

                </div>

            </form>
        </div>
    </div>


    {{-- ================================================================
        ESTILOS
    ================================================================= --}}
    <style>
        [x-cloak] {
            display: none !important;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 600;
            color: rgb(51 65 85);
        }

        .dark .form-label {
            color: rgb(226 232 240);
        }

        .form-input {
            display: block;
            width: 100%;
            min-height: 46px;
            border-radius: 0.75rem;
            border: 1px solid rgb(203 213 225);
            background-color: rgb(255 255 255);
            padding: 0.7rem 0.875rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: rgb(15 23 42);
            outline: none;
            transition:
                border-color 0.15s ease,
                box-shadow 0.15s ease,
                background-color 0.15s ease;
        }

        .form-input::placeholder {
            color: rgb(148 163 184);
        }

        .form-input:focus {
            border-color: rgb(6 182 212);
            box-shadow: 0 0 0 3px rgb(6 182 212 / 0.12);
        }

        .dark .form-input {
            border-color: rgb(71 85 105);
            background-color: rgb(30 41 59);
            color: rgb(241 245 249);
        }

        .dark .form-input::placeholder {
            color: rgb(100 116 139);
        }

        .dark .form-input:focus {
            border-color: rgb(34 211 238);
            box-shadow: 0 0 0 3px rgb(34 211 238 / 0.12);
        }

        .form-input:disabled,
        .form-input:read-only {
            cursor: not-allowed;
        }

        select.form-input {
            cursor: pointer;
        }

        textarea.form-input {
            min-height: 110px;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 0.5;
        }
    </style>


    {{-- ================================================================
        ALPINE
    ================================================================= --}}
    <script>
        function productForm() {
            return {
                manejaSeries: @json((bool) old('maneja_series', false)),

                aplicaDescuento: @json((bool) old('aplica_descuento', false)),

                categoryId: @json(old('category_id', '')),

                subcategoryId: @json(old('subcategory_id', '')),

                precioCompra: Number(@json(old('costo_compra', 0))) || 0,

                precioPublico: Number(@json(old('precio_publico', 0))) || 0,

                gananciaPorcentaje: Number(@json(old('ganancia_porcentaje', 0))) || 0,

                showSeriesForm: false,

                newSeries: {
                    sucursal_id: '',
                    serie: '',
                },

                series: [],

                branches: @json(
                    $branches->map(fn ($branch) => [
                        'id' => (string) $branch->id,
                        'nombre' => $branch->nombre,
                    ])->values()
                ),

                init() {
                    this.filterSubcategories();
                    this.calcularGanancia();
                },

                generateCode() {
                    const random = Math.floor(
                        100000 + Math.random() * 900000
                    );

                    document.getElementById('codigo').value =
                        'PROD-' + random;
                },

                generateSeries() {
                    const random = Math.floor(
                        100000 + Math.random() * 900000
                    );

                    this.newSeries.serie =
                        'SN-' + random;
                },

                calcularGanancia() {
                    const compra = Number(this.precioCompra) || 0;
                    const publico = Number(this.precioPublico) || 0;

                    if (compra <= 0 || publico <= 0) {
                        this.gananciaPorcentaje = 0;
                        return;
                    }

                    const ganancia =
                        ((publico - compra) / compra) * 100;

                    this.gananciaPorcentaje =
                        Math.max(0, ganancia).toFixed(2);
                },

                toggleSeries() {
                    this.manejaSeries = !this.manejaSeries;

                    if (!this.manejaSeries) {
                        this.showSeriesForm = false;
                        this.series = [];
                    }
                },

                openSeriesForm() {
                    this.showSeriesForm = true;

                    this.newSeries = {
                        sucursal_id: '',
                        serie: '',
                    };
                },

                cancelSeriesForm() {
                    this.showSeriesForm = false;

                    this.newSeries = {
                        sucursal_id: '',
                        serie: '',
                    };
                },

                addSeries() {
                    if (!this.newSeries.sucursal_id) {
                        alert('Selecciona una sucursal.');
                        return;
                    }

                    if (!this.newSeries.serie.trim()) {
                        alert('Ingresa o genera una serie.');
                        return;
                    }

                    const serie =
                        this.newSeries.serie.trim();

                    const duplicate = this.series.some(
                        item =>
                            item.serie.toLowerCase() ===
                            serie.toLowerCase()
                    );

                    if (duplicate) {
                        alert('Esta serie ya fue agregada.');
                        return;
                    }

                    this.series.push({
                        sucursal_id:
                            this.newSeries.sucursal_id,

                        serie: serie,
                    });

                    this.cancelSeriesForm();
                },

                removeSeries(index) {
                    this.series.splice(index, 1);
                },

                getBranchName(id) {
                    const branch = this.branches.find(
                        item =>
                            String(item.id) === String(id)
                    );

                    return branch
                        ? branch.nombre
                        : 'Sucursal';
                },

                filterSubcategories() {
                    const select =
                        document.getElementById('subcategory_id');

                    if (!select) {
                        return;
                    }

                    const currentValue =
                        this.subcategoryId;

                    Array.from(select.options).forEach(option => {

                        if (!option.value) {
                            option.hidden = false;
                            return;
                        }

                        const parentId =
                            option.dataset.parent;

                        option.hidden =
                            this.categoryId &&
                            parentId !==
                            String(this.categoryId);
                    });

                    const selectedOption =
                        select.querySelector(
                            `option[value="${currentValue}"]`
                        );

                    if (
                        currentValue &&
                        selectedOption &&
                        selectedOption.hidden
                    ) {
                        this.subcategoryId = '';
                    }
                },
            };
        }
    </script>
</x-app-layout>