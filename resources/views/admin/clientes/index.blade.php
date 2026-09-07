<x-app-layout>

    <style>
        /* ============================================================
           IMPRESIÓN
        ============================================================ */

        .print-only {
            display: none;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 14mm;
            }

            html,
            body {
                background: #ffffff !important;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
            }

            body * {
                visibility: hidden !important;
            }

            #customers-print-area,
            #customers-print-area * {
                visibility: visible !important;
            }

            #customers-print-area {
                display: block !important;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background: #ffffff !important;
            }

            .print-only {
                display: block !important;
            }

            .print-header {
                display: block !important;
                margin-bottom: 20px;
                padding-bottom: 12px;
                border-bottom: 2px solid #1e293b;
            }

            .print-brand {
                font-size: 20px;
                font-weight: 800;
                color: #1e293b;
                margin: 0 0 3px 0;
            }

            .print-title {
                font-size: 14px;
                font-weight: 700;
                color: #475569;
                margin: 0 0 5px 0;
            }

            .print-info {
                font-size: 9px;
                color: #64748b;
                margin: 0;
            }

            .print-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 8px;
            }

            .print-table thead {
                display: table-header-group;
            }

            .print-table tr {
                page-break-inside: avoid;
            }

            .print-table th {
                background: #1e293b !important;
                color: #ffffff !important;
                font-size: 9px;
                font-weight: 700;
                padding: 8px 7px;
                text-align: left;
                border: 1px solid #1e293b;
            }

            .print-table td {
                color: #334155 !important;
                font-size: 9px;
                padding: 7px;
                border: 1px solid #cbd5e1;
                vertical-align: middle;
            }

            .print-table tbody tr:nth-child(even) td {
                background: #f8fafc !important;
            }

            .print-name {
                font-weight: 700;
            }

            .print-footer {
                display: block !important;
                position: fixed;
                bottom: -7mm;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 8px;
                color: #94a3b8;
            }
        }
    </style>


    <div class="min-h-screen bg-slate-50 px-4 py-8 transition-colors duration-300 dark:bg-slate-950 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl">


            {{-- ============================================================
                 ENCABEZADO
            ============================================================= --}}

            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div class="mb-3 flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-slate-900 dark:bg-white"></span>

                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                            Administración
                        </span>

                    </div>

                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Clientes
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                        Consulta y administra la información de los clientes registrados en Delta System.
                    </p>

                </div>

                <a
                    href="{{ route('customers.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                >

                    <svg
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

                    Nuevo cliente

                </a>

            </div>


            {{-- ============================================================
                 SUBMÓDULOS
            ============================================================= --}}

            <div class="mb-8 overflow-x-auto">

                <div class="flex min-w-max gap-2 rounded-2xl border border-slate-200 bg-white p-2 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    {{-- Agregar --}}

                    <a
                        href="{{ route('customers.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>

                        <span>Agregar</span>

                    </a>


                    {{-- Listado --}}

                    <a
                        href="{{ route('customers.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white shadow-sm dark:bg-white dark:text-slate-900"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"
                            />
                        </svg>

                        <span>Listado</span>

                    </a>


                    {{-- Aperturar crédito --}}

                    <div
                        class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-300 dark:text-slate-700"
                        title="Este submódulo estará disponible próximamente"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 14l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                        <span>Aperturar crédito</span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[9px] font-bold uppercase tracking-wide text-slate-400 dark:bg-slate-800 dark:text-slate-600">
                            Próximo
                        </span>

                    </div>


                    {{-- Líneas de crédito --}}

                    <div
                        class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-300 dark:text-slate-700"
                        title="Este submódulo estará disponible próximamente"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>

                        <span>Líneas de crédito</span>

                        <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[9px] font-bold uppercase tracking-wide text-slate-400 dark:bg-slate-800 dark:text-slate-600">
                            Próximo
                        </span>

                    </div>

                </div>

            </div>


            {{-- ============================================================
                 MENSAJE DE ÉXITO
            ============================================================= --}}

            @if(session('success'))

                <div class="mb-8 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
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


            {{-- ============================================================
                 LISTADO
            ============================================================= --}}

            @if($customers->isEmpty())

                {{-- Estado vacío --}}

                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">

                        <svg
                            class="h-9 w-9"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19a4 4 0 00-8 0m4-8a3 3 0 100-6 3 3 0 000 6zm8 8a4 4 0 00-3-3.87M17 5.13a3 3 0 010 5.74"
                            />
                        </svg>

                    </div>

                    <h2 class="mt-6 text-xl font-extrabold text-slate-900 dark:text-white">
                        No hay clientes todavía
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Registra el primer cliente para comenzar a gestionar su información en Delta System.
                    </p>

                    <a
                        href="{{ route('customers.create') }}"
                        class="mt-7 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                    >

                        <svg
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

                        Agregar primer cliente

                    </a>

                </div>

            @else


                {{-- ========================================================
                     BARRA DE HERRAMIENTAS
                ========================================================= --}}

                <div class="mb-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <span class="h-2 w-2 rounded-full bg-slate-900 dark:bg-white"></span>

                            <p class="text-sm font-bold text-slate-900 dark:text-white">
                                Directorio de clientes
                            </p>

                        </div>

                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Consulta, busca y administra los registros existentes.
                        </p>

                    </div>


                    {{-- Búsqueda + exportación --}}

                    <div class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto">

                        {{-- Búsqueda --}}

                        <div class="relative w-full sm:w-80">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>

                            </div>

                            <input
                                id="customer-search"
                                type="text"
                                placeholder="Buscar cliente..."
                                autocomplete="off"
                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            />

                            <button
                                id="clear-search"
                                type="button"
                                class="absolute inset-y-0 right-0 hidden items-center pr-4 text-slate-400 transition hover:text-slate-700 dark:hover:text-white"
                                title="Limpiar búsqueda"
                            >

                                <svg
                                    class="h-4 w-4"
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

                            </button>

                        </div>


                        {{-- Excel --}}

                        <a
                            id="export-excel"
                            href="{{ route('customers.export.excel') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700 transition hover:bg-emerald-100 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-400 dark:hover:bg-emerald-950/50"
                            title="Exportar clientes a Excel"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 3v3m8-3v3M4 9h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 13h3v4H8zm5 0h3v4h-3z"
                                />
                            </svg>

                            <span>Excel</span>

                        </a>


                        {{-- PDF --}}

                        <a
                            id="export-pdf"
                            href="{{ route('customers.export.pdf') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-700 transition hover:bg-red-100 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-400 dark:hover:bg-red-950/50"
                            title="Exportar clientes a PDF"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 3v5h5M9 13h6M9 17h4"
                                />
                            </svg>

                            <span>PDF</span>

                        </a>


                        {{-- Imprimir --}}

                        <button
                            id="print-customers"
                            type="button"
                            onclick="window.print()"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                            title="Imprimir listado"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 9V4h12v5M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 14h12v6H6z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 12h.01"
                                />
                            </svg>

                            <span>Imprimir</span>

                        </button>

                    </div>

                </div>


                {{-- ========================================================
                     LISTA DE CLIENTES
                ========================================================= --}}

                <div
                    id="customers-list"
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >

                    {{-- Encabezados desktop --}}

                    <div class="hidden border-b border-slate-200 bg-slate-50 px-6 py-4 dark:border-slate-800 dark:bg-slate-950/60 md:grid md:grid-cols-[2fr_1.4fr_1.5fr_1.4fr_auto] md:items-center md:gap-6">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Cliente
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Empresa
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Contacto
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Ubicación
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Acciones
                        </p>

                    </div>


                    {{-- Clientes --}}

                    <div class="divide-y divide-slate-200 dark:divide-slate-800">

                        @foreach($customers as $customer)

                            @php
                                $fullName = trim(
                                    $customer->nombre . ' ' .
                                    $customer->apellido_paterno . ' ' .
                                    $customer->apellido_materno
                                );
                            @endphp


                            <div
                                class="customer-row group px-5 py-5 transition duration-200 hover:bg-slate-50 dark:hover:bg-slate-800/40 md:px-6"
                                data-search="{{ strtolower(
                                    $fullName . ' ' .
                                    $customer->telefono . ' ' .
                                    $customer->whatsapp . ' ' .
                                    $customer->correo
                                ) }}"
                            >

                                {{-- ====================================================
                                     DESKTOP
                                ===================================================== --}}

                                <div class="hidden md:grid md:grid-cols-[2fr_1.4fr_1.5fr_1.4fr_auto] md:items-center md:gap-6">

                                    {{-- Cliente --}}

                                    <div class="flex min-w-0 items-center gap-4">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-sm font-extrabold text-slate-600 transition duration-200 group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:group-hover:bg-slate-700">
                                            {{ strtoupper(substr($customer->nombre, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-bold text-slate-900 dark:text-white">
                                                {{ $fullName }}
                                            </p>

                                            <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                                {{ $customer->correo }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- Empresa --}}

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium text-slate-700 dark:text-slate-200">
                                            {{ $customer->empresa ?: 'Sin empresa' }}
                                        </p>

                                    </div>


                                    {{-- Contacto --}}

                                    <div>

                                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                            {{ $customer->telefono ?: 'Sin teléfono' }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            WhatsApp: {{ $customer->whatsapp ?: 'No registrado' }}
                                        </p>

                                    </div>


                                    {{-- Ubicación --}}

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium text-slate-700 dark:text-slate-200">
                                            {{ $customer->municipio ?: 'Sin municipio' }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                            {{ $customer->estado ?: 'Sin estado' }}
                                        </p>

                                    </div>


                                    {{-- Acciones --}}

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Ver --}}

                                        <a
                                            href="{{ route('customers.show', $customer) }}"
                                            title="Ver detalles"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                                        >

                                            <svg
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

                                        </a>


                                        {{-- Editar --}}

                                        <a
                                            href="{{ route('customers.edit', $customer) }}"
                                            title="Editar"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                                        >

                                            <svg
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

                                        </a>


                                        {{-- Eliminar --}}

                                        <form
                                            action="{{ route('customers.destroy', $customer) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Eliminar"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 text-red-500 transition duration-200 hover:-translate-y-0.5 hover:bg-red-50 hover:text-red-700 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/30"
                                            >

                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                                    />
                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </div>


                                {{-- ====================================================
                                     MÓVIL
                                ===================================================== --}}

                                <div class="md:hidden">

                                    <div class="flex items-start gap-4">

                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-sm font-extrabold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                            {{ strtoupper(substr($customer->nombre, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0 flex-1">

                                            <p class="text-sm font-bold text-slate-900 dark:text-white">
                                                {{ $fullName }}
                                            </p>

                                            <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                                {{ $customer->correo }}
                                            </p>

                                        </div>

                                    </div>


                                    <div class="mt-5 grid grid-cols-2 gap-x-5 gap-y-4">

                                        <div>

                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                Empresa
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->empresa ?: 'Sin empresa' }}
                                            </p>

                                        </div>


                                        <div>

                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                Teléfono
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->telefono ?: 'Sin teléfono' }}
                                            </p>

                                        </div>


                                        <div>

                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                WhatsApp
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->whatsapp ?: 'No registrado' }}
                                            </p>

                                        </div>


                                        <div>

                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                Ubicación
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->municipio ?: 'Sin municipio' }}, {{ $customer->estado ?: 'Sin estado' }}
                                            </p>

                                        </div>

                                    </div>


                                    <div class="mt-5 grid grid-cols-3 gap-2">

                                        <a
                                            href="{{ route('customers.show', $customer) }}"
                                            class="rounded-lg border border-slate-200 px-3 py-2.5 text-center text-xs font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('customers.edit', $customer) }}"
                                            class="rounded-lg bg-slate-900 px-3 py-2.5 text-center text-xs font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('customers.destroy', $customer) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="w-full rounded-lg border border-red-200 px-3 py-2.5 text-xs font-bold text-red-500 transition hover:bg-red-50 hover:text-red-700 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/30"
                                            >
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- ========================================================
                     SIN RESULTADOS DE BÚSQUEDA
                ========================================================= --}}

                <div
                    id="no-search-results"
                    class="mt-4 hidden rounded-2xl border border-slate-200 bg-white px-6 py-12 text-center shadow-sm dark:border-slate-800 dark:bg-slate-900"
                >

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>

                    </div>

                    <h2 class="mt-4 text-lg font-bold text-slate-900 dark:text-white">
                        No se encontraron clientes
                    </h2>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Intenta buscar con otro nombre, teléfono, WhatsApp o correo.
                    </p>

                </div>


                {{-- ========================================================
                     ÁREA EXCLUSIVA PARA IMPRESIÓN
                ========================================================= --}}

                <div
                    id="customers-print-area"
                    class="print-only"
                >

                    <div class="print-header">

                        <p class="print-brand">
                            Delta System
                        </p>

                        <p class="print-title">
                            Listado de clientes
                        </p>

                        <p class="print-info">
                            Fecha de generación:
                            {{ now()->format('d/m/Y H:i') }}
                        </p>

                    </div>


                    <table class="print-table">

                        <thead>

                            <tr>

                                <th style="width: 24%;">
                                    Cliente
                                </th>

                                <th style="width: 18%;">
                                    Empresa
                                </th>

                                <th style="width: 16%;">
                                    Teléfono
                                </th>

                                <th style="width: 16%;">
                                    WhatsApp
                                </th>

                                <th style="width: 26%;">
                                    Correo
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($customers as $customer)

                                @php
                                    $fullName = trim(
                                        $customer->nombre . ' ' .
                                        $customer->apellido_paterno . ' ' .
                                        $customer->apellido_materno
                                    );
                                @endphp

                                <tr
                                    class="print-customer-row"
                                    data-search="{{ strtolower(
                                        $fullName . ' ' .
                                        $customer->telefono . ' ' .
                                        $customer->whatsapp . ' ' .
                                        $customer->correo
                                    ) }}"
                                >

                                    <td class="print-name">
                                        {{ $fullName }}
                                    </td>

                                    <td>
                                        {{ $customer->empresa ?: 'Sin empresa' }}
                                    </td>

                                    <td>
                                        {{ $customer->telefono ?: 'Sin teléfono' }}
                                    </td>

                                    <td>
                                        {{ $customer->whatsapp ?: 'No registrado' }}
                                    </td>

                                    <td>
                                        {{ $customer->correo }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>


                    <div class="print-footer">
                        Delta System · Listado de clientes
                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- ================================================================
         FILTRADO + EXPORTACIÓN + IMPRESIÓN
    ================================================================= --}}

    @if(!$customers->isEmpty())

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const searchInput = document.getElementById('customer-search');
                const clearButton = document.getElementById('clear-search');

                const rows = document.querySelectorAll('.customer-row');
                const printRows = document.querySelectorAll('.print-customer-row');

                const noResults = document.getElementById('no-search-results');

                const exportExcel = document.getElementById('export-excel');
                const exportPdf = document.getElementById('export-pdf');

                const exportExcelUrl = exportExcel.href;
                const exportPdfUrl = exportPdf.href;


                function filterCustomers() {

                    const search = searchInput.value
                        .toLowerCase()
                        .trim();


                    /* ====================================================
                       ACTUALIZA EXCEL
                    ==================================================== */

                    const excelSeparator = exportExcelUrl.includes('?')
                        ? '&'
                        : '?';

                    exportExcel.href = search
                        ? `${exportExcelUrl}${excelSeparator}search=${encodeURIComponent(search)}`
                        : exportExcelUrl;


                    /* ====================================================
                       ACTUALIZA PDF
                    ==================================================== */

                    const pdfSeparator = exportPdfUrl.includes('?')
                        ? '&'
                        : '?';

                    exportPdf.href = search
                        ? `${exportPdfUrl}${pdfSeparator}search=${encodeURIComponent(search)}`
                        : exportPdfUrl;


                    /* ====================================================
                       FILTRA LISTADO
                    ==================================================== */

                    let matches = 0;

                    rows.forEach(row => {

                        const data = row.dataset.search || '';

                        const matchesSearch = data.includes(search);

                        row.style.display = matchesSearch
                            ? ''
                            : 'none';

                        if (matchesSearch) {
                            matches++;
                        }

                    });


                    /* ====================================================
                       FILTRA IMPRESIÓN
                    ==================================================== */

                    printRows.forEach(row => {

                        const data = row.dataset.search || '';

                        const matchesSearch = data.includes(search);

                        row.style.display = matchesSearch
                            ? ''
                            : 'none';

                    });


                    /* ====================================================
                       BOTÓN LIMPIAR
                    ==================================================== */

                    if (search.length > 0) {

                        clearButton.classList.remove('hidden');
                        clearButton.classList.add('flex');

                    } else {

                        clearButton.classList.add('hidden');
                        clearButton.classList.remove('flex');

                    }


                    /* ====================================================
                       SIN RESULTADOS
                    ==================================================== */

                    if (matches === 0) {

                        noResults.classList.remove('hidden');

                    } else {

                        noResults.classList.add('hidden');

                    }

                }


                /* ========================================================
                   EVENTOS
                ========================================================= */

                searchInput.addEventListener('input', filterCustomers);


                clearButton.addEventListener('click', function () {

                    searchInput.value = '';

                    filterCustomers();

                    searchInput.focus();

                });


                /* ========================================================
                   INICIALIZAR
                ========================================================= */

                filterCustomers();

            });
        </script>

    @endif

</x-app-layout>
