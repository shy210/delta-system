<x-app-layout>

    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
            }

            body * {
                visibility: hidden;
            }

            #suppliers-print-area,
            #suppliers-print-area * {
                visibility: visible;
            }

            #suppliers-print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }

            .print-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 9px;
            }

            .print-table th,
            .print-table td {
                border: 1px solid #d1d5db;
                padding: 6px;
                text-align: left;
            }

            .print-table th {
                background-color: #e5e7eb !important;
                color: #111827 !important;
            }

            .print-title {
                display: block !important;
                margin-bottom: 20px;
            }

            @page {
                size: landscape;
                margin: 10mm;
            }
        }

        .print-title {
            display: none;
        }
    </style>

    <div class="min-h-screen bg-slate-50 py-8 dark:bg-slate-950">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- ENCABEZADO --}}
            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div>
                    <div class="mb-3 flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-slate-700 dark:bg-slate-300"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                            Inventario
                        </span>
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Proveedores
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Administra los proveedores y la información de contacto asociada al inventario.
                    </p>
                </div>

                <a
                    href="{{ route('suppliers.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Nuevo proveedor
                </a>
            </div>


           {{-- NAVEGACIÓN DE INVENTARIO --}}
<div class="no-print mb-8 overflow-x-auto">
    <div class="flex min-w-max gap-2 rounded-2xl border border-slate-200 bg-white p-2 shadow-sm dark:border-slate-800 dark:bg-slate-900">

        {{-- PRODUCTOS --}}
        <a
            href="{{ route('products.index') }}"
            class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
        >
            Productos
        </a>

        {{-- CATEGORÍAS --}}
        <a
            href="{{ route('categories.index') }}"
            class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
        >
            Categorías
        </a>

        {{-- PROVEEDORES --}}
        <a
            href="{{ route('suppliers.index') }}"
            class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
        >
            Proveedores
        </a>

        {{-- AJUSTES --}}
        <a
            href="{{ route('inventory-adjustments.index') }}"
            class="rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
        >
            Ajustes
        </a>

        {{-- SERVICIOS COMBO --}}
        <a
            href="{{ route('service-combos.index') }}"
            class="rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-sm dark:bg-white dark:text-slate-900"
        >
            Servicios combo
        </a>

    </div>
</div>

            {{-- MENSAJE DE ÉXITO --}}
            @if (session('success'))

                <div class="no-print mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- MENSAJE DE ERROR --}}
            @if (session('error'))

                <div class="no-print mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-300">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"
                        />
                    </svg>

                    <p class="text-sm font-medium">
                        {{ session('error') }}
                    </p>

                </div>

            @endif


            {{-- ÁREA DE IMPRESIÓN --}}
            <div id="suppliers-print-area">

                {{-- TÍTULO PARA IMPRESIÓN --}}
                <div class="print-title">

                    <h1 class="text-2xl font-bold">
                        Proveedores
                    </h1>

                    <p>
                        Fecha de impresión:
                        {{ now()->format('d/m/Y H:i') }}
                    </p>

                    @if ($search)
                        <p>
                            Búsqueda:
                            {{ $search }}
                        </p>
                    @endif

                </div>


                {{-- CONTENEDOR PRINCIPAL --}}
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    {{-- ENCABEZADO DEL DIRECTORIO --}}
                    <div class="border-b border-slate-200 px-5 py-5 dark:border-slate-800 sm:px-7">

                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                            <div>

                                <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                                    Directorio de proveedores
                                </h2>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    Consulta, administra y controla los proveedores registrados en el inventario.
                                </p>

                            </div>


                            {{-- BOTONES DE EXPORTACIÓN --}}
                            <div class="no-print flex flex-wrap gap-2">

                                {{-- EXCEL --}}
                                <a
                                    href="{{ route('suppliers.export-excel', ['search' => $search]) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300 dark:hover:bg-emerald-900/50"
                                >
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
                                            d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14 2v6h6M8 13l2 2-2 2m8-4l-2 2 2 2"
                                        />
                                    </svg>

                                    Excel
                                </a>


                                {{-- PDF --}}
                                <a
                                    href="{{ route('suppliers.export-pdf', ['search' => $search]) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-xs font-bold text-red-700 transition hover:bg-red-100 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-300 dark:hover:bg-red-900/50"
                                >
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
                                            d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 3v5h5M8 13h8M8 17h6"
                                        />
                                    </svg>

                                    PDF
                                </a>


                                {{-- IMPRIMIR --}}
                                <button
                                    type="button"
                                    onclick="window.print()"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-100 px-4 py-2.5 text-xs font-bold text-slate-700 transition hover:bg-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
                                >
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
                                            d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5h-2"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 14h12v8H6z"
                                        />
                                    </svg>

                                    Imprimir
                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- BUSCADOR --}}
                    <div class="no-print border-b border-slate-200 bg-slate-50/70 px-5 py-5 dark:border-slate-800 dark:bg-slate-950/40 sm:px-7">

                        <form
                            action="{{ route('suppliers.index') }}"
                            method="GET"
                            class="flex flex-col gap-3 sm:flex-row"
                        >

                            <div class="relative flex-1">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                        />
                                    </svg>

                                </div>

                                <input
                                    id="supplier-search"
                                    type="text"
                                    name="search"
                                    value="{{ $search }}"
                                    placeholder="Buscar por nombre, WhatsApp, teléfono, correo o dirección..."
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                />

                            </div>


                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                            >
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
                                        d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                    />
                                </svg>

                                Buscar
                            </button>


                            @if ($search)

                                <a
                                    href="{{ route('suppliers.index') }}"
                                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
                                    title="Limpiar búsqueda"
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
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </a>

                            @endif

                        </form>

                    </div>


                    {{-- CONTENIDO --}}
                    <div class="px-5 py-5 sm:px-7">

                        @if ($suppliers->count() > 0)

                            {{-- TABLA PARA COMPUTADORA --}}
                            <div class="hidden overflow-x-auto md:block">

                                <table class="min-w-[950px] divide-y divide-slate-200 dark:divide-slate-800">

                                    <thead>

                                        <tr class="text-left">

                                            <th class="whitespace-nowrap px-4 py-4 text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                Proveedor
                                            </th>

                                            <th class="whitespace-nowrap px-4 py-4 text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                WhatsApp
                                            </th>

                                            <th class="whitespace-nowrap px-4 py-4 text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                Teléfono
                                            </th>

                                            <th class="whitespace-nowrap px-4 py-4 text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                Fecha de registro
                                            </th>

                                            <th class="whitespace-nowrap px-4 py-4 text-right text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                Acciones
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                                        @foreach ($suppliers as $supplier)

                                            <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">

                                                {{-- PROVEEDOR --}}
                                                <td class="px-4 py-5">

                                                    <div class="flex items-center gap-3">

                                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                                            {{ strtoupper(substr($supplier->nombre, 0, 1)) }}
                                                        </div>

                                                        <div class="min-w-0">

                                                            <p class="font-semibold text-slate-900 dark:text-white">
                                                                {{ $supplier->nombre }}
                                                            </p>

                                                            @if ($supplier->correo)

                                                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                                                    {{ $supplier->correo }}
                                                                </p>

                                                            @endif

                                                        </div>

                                                    </div>

                                                </td>


                                                {{-- WHATSAPP --}}
                                                <td class="px-4 py-5 text-sm text-slate-600 dark:text-slate-300">
                                                    {{ $supplier->whatsapp ?: '—' }}
                                                </td>


                                                {{-- TELÉFONO --}}
                                                <td class="px-4 py-5 text-sm text-slate-600 dark:text-slate-300">
                                                    {{ $supplier->telefono ?: '—' }}
                                                </td>


                                                {{-- FECHA --}}
                                                <td class="px-4 py-5 text-sm text-slate-600 dark:text-slate-300">
                                                    {{ $supplier->created_at?->format('d/m/Y H:i') ?? '—' }}
                                                </td>


                                                {{-- ACCIONES --}}
                                                <td class="px-4 py-5">

                                                    <div class="flex items-center justify-end gap-2">

                                                        {{-- VER --}}
                                                        <a
                                                            href="{{ route('suppliers.show', $supplier) }}"
                                                            class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                                                            title="Ver proveedor"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="mr-1.5 h-4 w-4"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                                />

                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                                />
                                                            </svg>

                                                            Ver
                                                        </a>


                                                        {{-- EDITAR --}}
                                                        <a
                                                            href="{{ route('suppliers.edit', $supplier) }}"
                                                            class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-bold text-blue-700 transition hover:bg-blue-100 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300 dark:hover:bg-blue-900/50"
                                                            title="Editar proveedor"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="mr-1.5 h-4 w-4"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                                                />

                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                                />
                                                            </svg>

                                                            Editar
                                                        </a>


                                                        {{-- ELIMINAR --}}
                                                        <form
                                                            action="{{ route('suppliers.destroy', $supplier) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('¿Estás segura de que deseas eliminar este proveedor?');"
                                                        >

                                                            @csrf
                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-100 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-300 dark:hover:bg-red-900/50"
                                                                title="Eliminar proveedor"
                                                            >
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    class="mr-1.5 h-4 w-4"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
                                                                    />
                                                                </svg>

                                                                Eliminar
                                                            </button>

                                                        </form>

                                                    </div>

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>


                            {{-- TARJETAS PARA CELULAR --}}
                            <div class="space-y-4 md:hidden">

                                @foreach ($suppliers as $supplier)

                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-950/50">

                                        {{-- ENCABEZADO DE TARJETA --}}
                                        <div class="mb-4 flex items-start gap-3">

                                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-sm font-bold text-slate-700 shadow-sm dark:bg-slate-800 dark:text-slate-200">
                                                {{ strtoupper(substr($supplier->nombre, 0, 1)) }}
                                            </div>

                                            <div class="min-w-0 flex-1">

                                                <p class="font-bold text-slate-900 dark:text-white">
                                                    {{ $supplier->nombre }}
                                                </p>

                                                @if ($supplier->correo)

                                                    <p class="mt-1 break-all text-xs text-slate-500 dark:text-slate-400">
                                                        {{ $supplier->correo }}
                                                    </p>

                                                @endif

                                            </div>

                                        </div>


                                        {{-- INFORMACIÓN --}}
                                        <div class="grid grid-cols-1 gap-4 border-y border-slate-200 py-4 dark:border-slate-800 sm:grid-cols-2">

                                            <div>

                                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                                    WhatsApp
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                                    {{ $supplier->whatsapp ?: 'Sin registrar' }}
                                                </p>

                                            </div>


                                            <div>

                                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                                    Teléfono
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                                    {{ $supplier->telefono ?: 'Sin registrar' }}
                                                </p>

                                            </div>


                                            <div>

                                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                                    Correo
                                                </p>

                                                <p class="mt-1 break-all text-sm font-semibold text-slate-900 dark:text-white">
                                                    {{ $supplier->correo ?: 'Sin registrar' }}
                                                </p>

                                            </div>


                                            <div>

                                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                                    Fecha de registro
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                                    {{ $supplier->created_at?->format('d/m/Y H:i') ?? '—' }}
                                                </p>

                                            </div>

                                        </div>


                                        {{-- DIRECCIÓN --}}
                                        <div class="mt-4 rounded-xl bg-white p-4 dark:bg-slate-900">

                                            <p class="text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                                Dirección
                                            </p>

                                            <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">
                                                {{ $supplier->direccion ?: 'Sin dirección registrada' }}
                                            </p>

                                        </div>


                                        {{-- ACCIONES --}}
                                        <div class="mt-4 grid grid-cols-3 gap-2">

                                            {{-- VER --}}
                                            <a
                                                href="{{ route('suppliers.show', $supplier) }}"
                                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-2 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="mr-1 h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                    />
                                                </svg>

                                                Ver
                                            </a>


                                            {{-- EDITAR --}}
                                            <a
                                                href="{{ route('suppliers.edit', $supplier) }}"
                                                class="inline-flex items-center justify-center rounded-xl border border-blue-200 bg-blue-50 px-2 py-2.5 text-xs font-bold text-blue-700 transition hover:bg-blue-100 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="mr-1 h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                    />
                                                </svg>

                                                Editar
                                            </a>


                                            {{-- ELIMINAR --}}
                                            <form
                                                action="{{ route('suppliers.destroy', $supplier) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Estás segura de que deseas eliminar este proveedor?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex w-full items-center justify-center rounded-xl border border-red-200 bg-red-50 px-2 py-2.5 text-xs font-bold text-red-700 transition hover:bg-red-100 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-300"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="mr-1 h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
                                                        />
                                                    </svg>

                                                    Eliminar
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            {{-- ESTADO VACÍO --}}
                            <div class="py-16 text-center">

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M20.25 7.5v9a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 16.5v-9A2.25 2.25 0 016 5.25h12a2.25 2.25 0 012.25 2.25Z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.75 9h16.5"
                                        />
                                    </svg>

                                </div>


                                <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">
                                    Ningún dato disponible en esta tabla
                                </h3>


                                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500 dark:text-slate-400">

                                    @if ($search)

                                        No se encontraron proveedores que coincidan con la búsqueda.

                                    @else

                                        Todavía no se han registrado proveedores.

                                    @endif

                                </p>


                                @if ($search)

                                    <a
                                        href="{{ route('suppliers.index') }}"
                                        class="no-print mt-6 inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
                                    >
                                        Limpiar búsqueda
                                    </a>

                                @else

                                    <a
                                        href="{{ route('suppliers.create') }}"
                                        class="no-print mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
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
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>

                                        Crear proveedor
                                    </a>

                                @endif

                            </div>

                        @endif

                    </div>


                    {{-- PAGINACIÓN --}}
                    @if ($suppliers->hasPages())

                        <div class="no-print border-t border-slate-200 px-5 py-5 dark:border-slate-800 sm:px-7">
                            {{ $suppliers->withQueryString()->links() }}
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>