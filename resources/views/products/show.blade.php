<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400">
                    Inventario
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                    Detalle del producto
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Consulta toda la información registrada del producto.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12l7.5-7.5M3 12h18"/>
                    </svg>
                    Regresar
                </a>

                <a
                    href="{{ route('products.edit', $product) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/>
                    </svg>
                    Editar producto
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Navegación del inventario --}}
            <div class="overflow-x-auto">
                <nav class="flex min-w-max gap-2 rounded-2xl border border-slate-200 bg-white p-2 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <a
                        href="{{ route('products.index') }}"
                        class="rounded-xl bg-cyan-600 px-4 py-2 text-sm font-semibold text-white"
                    >
                        Productos
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="rounded-xl px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                    >
                        Categorías
                    </a>

                    <a
                        href="{{ route('suppliers.index') }}"
                        class="rounded-xl px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                    >
                        Proveedores
                    </a>

                    <a
                        href="#"
                        class="rounded-xl px-4 py-2 text-sm font-medium text-slate-400 dark:text-slate-500"
                    >
                        Ajustes
                    </a>

                    <a
                        href="#"
                        class="rounded-xl px-4 py-2 text-sm font-medium text-slate-400 dark:text-slate-500"
                    >
                        Servicios combo
                    </a>
                </nav>
            </div>

            {{-- Información principal --}}
            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Resumen --}}
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 lg:col-span-2">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                Producto
                            </p>

                            <h1 class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">
                                {{ $product->nombre }}
                            </h1>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Código: {{ $product->codigo }}
                            </p>
                        </div>

                        @if($product->activo)
                            <span class="inline-flex w-fit items-center rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                Activo
                            </span>
                        @else
                            <span class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                Inactivo
                            </span>
                        @endif
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

                        <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800/60">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Existencia
                            </p>

                            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                @if($product->maneja_series)
                                    {{ $product->series->count() }}
                                @else
                                    {{ number_format((float) $product->stock, 2) }}
                                @endif
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800/60">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Precio público
                            </p>

                            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                ${{ number_format((float) $product->precio_publico, 2) }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800/60">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Costo
                            </p>

                            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                ${{ number_format((float) $product->costo_compra, 2) }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800/60">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Ganancia
                            </p>

                            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                {{ number_format((float) $product->ganancia_porcentaje, 2) }}%
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Código / referencia --}}
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-900/30 dark:text-cyan-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5h16.5v15H3.75z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8v8M10 8v8M14 8v8M17 8v8"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-semibold text-slate-900 dark:text-white">
                                Identificación
                            </h3>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Datos principales
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-4">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Código / SKU
                            </p>

                            <p class="mt-1 break-all font-semibold text-slate-900 dark:text-white">
                                {{ $product->codigo }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Referencia
                            </p>

                            <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                {{ $product->referencia ?: 'Sin referencia' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Tipo de venta
                            </p>

                            <p class="mt-1 text-sm font-semibold capitalize text-slate-900 dark:text-white">
                                {{ $product->tipo_venta }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Datos generales --}}
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                        Datos generales
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Información de clasificación y descripción del producto.
                    </p>
                </div>

                <div class="grid gap-6 p-6 sm:grid-cols-2 lg:grid-cols-3">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Proveedor
                        </p>

                        <p class="mt-1 font-medium text-slate-900 dark:text-white">
                            {{ $product->proveedor?->nombre ?? 'Sin proveedor' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Categoría
                        </p>

                        <p class="mt-1 font-medium text-slate-900 dark:text-white">
                            {{ $product->categoriaRelacion?->nombre ?? $product->categoria ?? 'Sin categoría' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Subcategoría
                        </p>

                        <p class="mt-1 font-medium text-slate-900 dark:text-white">
                            {{ $product->subcategoria?->nombre ?? 'Sin subcategoría' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Locación
                        </p>

                        <p class="mt-1 font-medium text-slate-900 dark:text-white">
                            {{ $product->sucursal?->nombre ?? 'Sin sucursal' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Marca
                        </p>

                        <p class="mt-1 font-medium text-slate-900 dark:text-white">
                            {{ $product->marca ?: 'Sin marca' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Aplica descuento
                        </p>

                        @if($product->aplica_descuento)
                            <span class="mt-1 inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                                Sí
                            </span>
                        @else
                            <span class="mt-1 inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                No
                            </span>
                        @endif
                    </div>

                    <div class="sm:col-span-2 lg:col-span-3">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Descripción corta
                        </p>

                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700 dark:text-slate-300">
                            {{ $product->descripcion_corta ?: 'Sin descripción corta.' }}
                        </p>
                    </div>

                    <div class="sm:col-span-2 lg:col-span-3">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Descripción larga
                        </p>

                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700 dark:text-slate-300">
                            {{ $product->descripcion_larga ?: ($product->descripcion ?: 'Sin descripción larga.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Inventario --}}
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                                Inventario
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Información relacionada con las existencias del producto.
                            </p>
                        </div>

                        @if($product->maneja_series)
                            <span class="inline-flex w-fit rounded-full bg-cyan-50 px-3 py-1.5 text-xs font-semibold text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-300">
                                Maneja series
                            </span>
                        @else
                            <span class="inline-flex w-fit rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                Sin series
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-6">

                    @if($product->maneja_series)

                        @if($product->series->count())
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
                                    <thead>
                                        <tr class="text-left">
                                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                Sucursal
                                            </th>

                                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                Serie
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                                        @foreach($product->series as $serie)
                                            <tr>
                                                <td class="px-4 py-4 text-sm font-medium text-slate-900 dark:text-white">
                                                    {{ $serie->sucursal?->nombre ?? 'Sin sucursal' }}
                                                </td>

                                                <td class="px-4 py-4 text-sm text-slate-700 dark:text-slate-300">
                                                    {{ $serie->serie }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="rounded-2xl border border-dashed border-slate-300 p-6 text-center dark:border-slate-700">
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    No hay series registradas para este producto.
                                </p>
                            </div>
                        @endif

                    @else

                        <div class="grid gap-4 sm:grid-cols-3">

                            <div class="rounded-2xl bg-slate-50 p-5 dark:bg-slate-800/60">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    Existencia actual
                                </p>

                                <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                                    {{ number_format((float) $product->stock, 2) }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-5 dark:bg-slate-800/60">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    Existencia mínima
                                </p>

                                <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                                    {{ number_format((float) $product->stock_minimo, 2) }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-5 dark:bg-slate-800/60">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                    Existencia máxima
                                </p>

                                <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                                    {{ number_format((float) $product->stock_maximo, 2) }}
                                </p>
                            </div>

                        </div>

                    @endif
                </div>
            </div>

            {{-- Precios --}}
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                        Precios
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Costos y precios de venta registrados.
                    </p>
                </div>

                <div class="grid gap-4 p-6 sm:grid-cols-2 lg:grid-cols-3">

                    <div class="rounded-2xl border border-slate-200 p-5 dark:border-slate-800">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Precio de compra
                        </p>

                        <p class="mt-2 text-xl font-bold text-slate-900 dark:text-white">
                            ${{ number_format((float) $product->costo_compra, 2) }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-cyan-200 bg-cyan-50/50 p-5 dark:border-cyan-900 dark:bg-cyan-900/10">
                        <p class="text-xs font-medium uppercase tracking-wide text-cyan-700 dark:text-cyan-400">
                            Precio público
                        </p>

                        <p class="mt-2 text-xl font-bold text-slate-900 dark:text-white">
                            ${{ number_format((float) $product->precio_publico, 2) }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-5 dark:border-slate-800">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Ganancia
                        </p>

                        <p class="mt-2 text-xl font-bold text-slate-900 dark:text-white">
                            {{ number_format((float) $product->ganancia_porcentaje, 2) }}%
                        </p>
                    </div>

                    @foreach([
                        2 => $product->precio_2,
                        3 => $product->precio_3,
                        4 => $product->precio_4,
                        5 => $product->precio_5,
                        6 => $product->precio_6,
                    ] as $numero => $precio)

                        <div class="rounded-2xl border border-slate-200 p-5 dark:border-slate-800">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Precio {{ $numero }}
                            </p>

                            <p class="mt-2 text-xl font-bold text-slate-900 dark:text-white">
                                @if($precio !== null)
                                    ${{ number_format((float) $precio, 2) }}
                                @else
                                    —
                                @endif
                            </p>
                        </div>

                    @endforeach

                </div>
            </div>

            {{-- Información adicional --}}
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                        Información adicional
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Datos de registro del producto.
                    </p>
                </div>

                <div class="grid gap-6 p-6 sm:grid-cols-2">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Fecha de registro
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">
                            {{ $product->created_at?->format('d/m/Y H:i') ?? 'Sin información' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">
                            {{ $product->updated_at?->format('d/m/Y H:i') ?? 'Sin información' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Acciones --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                >
                    Regresar a productos
                </a>

                <a
                    href="{{ route('products.edit', $product) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/>
                    </svg>
                    Editar producto
                </a>
            </div>

        </div>
    </div>
</x-app-layout>