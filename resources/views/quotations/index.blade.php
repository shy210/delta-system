<x-app-layout>
    <div
        x-data="{
            search: '',
            rows: [],
            visibleCount: 0,

            init() {
                this.rows = Array.from(this.$refs.quotationTableBody.querySelectorAll('tr[data-search]'));
                this.filterQuotations();
            },

            filterQuotations() {
                const search = this.search.toLowerCase().trim();

                this.visibleCount = 0;

                this.rows.forEach(row => {
                    const text = row.dataset.search.toLowerCase();
                    const visible = text.includes(search);

                    row.classList.toggle('hidden', !visible);

                    if (visible) {
                        this.visibleCount++;
                    }
                });
            }
        }"
        x-init="init()"
        class="min-h-screen bg-slate-50 py-8 dark:bg-slate-950"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- ENCABEZADO --}}
            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div>
                    <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-cyan-600 dark:text-cyan-400">
                        Gestión comercial
                    </p>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Cotizaciones
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm text-slate-600 dark:text-slate-400">
                        Administra las cotizaciones generadas para tus clientes.
                    </p>
                </div>

                <a
                    href="{{ route('quotations.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
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

                    Agregar cotización
                </a>
            </div>

            {{-- MENSAJE DE ÉXITO --}}
            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-900/20 dark:text-emerald-300"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m5.25 12.75 4.5 4.5 9-10.5"
                        />
                    </svg>

                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- CONTENEDOR PRINCIPAL --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                {{-- BARRA SUPERIOR --}}
                <div class="border-b border-slate-200 p-5 dark:border-slate-800">

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                        {{-- BUSCADOR --}}
                        <div class="w-full lg:max-w-md">
                            <label class="sr-only" for="search">
                                Buscar cotización
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 1 1-13.5 0 6.75 6.75 0 0 1 13.5 0Z"
                                        />
                                    </svg>
                                </div>

                                <input
                                    id="search"
                                    type="text"
                                    x-model="search"
                                    @input="filterQuotations()"
                                    placeholder="Buscar cliente o folio..."
                                    class="block w-full rounded-xl border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 placeholder-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder-slate-500"
                                >
                            </div>
                        </div>

                        {{-- CONTADOR --}}
                        <div class="text-sm text-slate-500 dark:text-slate-400">
                            <span
                                x-text="visibleCount"
                                class="font-semibold text-slate-700 dark:text-slate-200"
                            ></span>

                            cotizaciones encontradas
                        </div>

                    </div>

                    {{-- ACCIONES DE EXPORTACIÓN --}}
                    <div class="mt-4 flex flex-wrap items-center gap-2">

                        {{-- PDF --}}
                        <button
                            type="button"
                            onclick="exportPDF()"
                            class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-red-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-red-400"
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
                                    d="M6.75 3.75h7.5L18.75 8.25v12a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V4.5a.75.75 0 0 1 .75-.75Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.25 3.75v4.5h4.5"
                                />
                            </svg>

                            PDF
                        </button>

                        {{-- EXCEL --}}
                        <button
                            type="button"
                            onclick="exportExcel()"
                            class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-emerald-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-emerald-400"
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
                                    d="M6.75 3.75h7.5L18.75 8.25v12a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V4.5a.75.75 0 0 1 .75-.75Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.25 3.75v4.5h4.5"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m8.25 13.5 3 3m0-3-3 3"
                                />
                            </svg>

                            Excel
                        </button>

                        {{-- IMPRIMIR --}}
                        <button
                            type="button"
                            onclick="printTable()"
                            class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-cyan-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-cyan-400"
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
                                    d="M6.75 9V4.5h10.5V9M6 18H4.5A1.5 1.5 0 0 1 3 16.5v-6A1.5 1.5 0 0 1 4.5 9h15a1.5 1.5 0 0 1 1.5 1.5v6a1.5 1.5 0 0 1-1.5 1.5H18"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.75 14.25h10.5v6H6.75v-6Z"
                                />
                            </svg>

                            Imprimir
                        </button>

                    </div>
                </div>

                {{-- TABLA --}}
                <div class="overflow-x-auto">

                    <table
                        id="quotationsTable"
                        class="w-full min-w-[900px] text-left"
                    >
                        <thead class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-800/50">
                            <tr>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Cliente
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Total
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Fecha de Cotización
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Vencimiento
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Fecha de registro
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    Acciones
                                </th>

                            </tr>
                        </thead>

                        <tbody
                            x-ref="quotationTableBody"
                            class="divide-y divide-slate-200 dark:divide-slate-800"
                        >

                            @forelse ($quotations as $quotation)

                                <tr
                                    data-search="{{ strtolower(
                                        trim(
                                            $quotation->customer->nombre . ' ' .
                                            $quotation->customer->apellido_paterno . ' ' .
                                            $quotation->customer->apellido_materno
                                        ) . ' ' .
                                        $quotation->folio
                                    ) }}"
                                    class="transition hover:bg-slate-50 dark:hover:bg-slate-800/40"
                                >

                                    {{-- CLIENTE --}}
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">

                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-cyan-100 text-sm font-bold text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300">
                                                {{ strtoupper(substr($quotation->customer->nombre ?? 'C', 0, 1)) }}
                                            </div>

                                            <div>
                                                <p class="font-semibold text-slate-900 dark:text-white">
                                                    {{ $quotation->customer->nombre }}
                                                    {{ $quotation->customer->apellido_paterno }}
                                                    {{ $quotation->customer->apellido_materno }}
                                                </p>

                                                <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                                    {{ $quotation->folio }}
                                                </p>
                                            </div>

                                        </div>
                                    </td>

                                    {{-- TOTAL --}}
                                    <td class="whitespace-nowrap px-6 py-5">
                                        <span class="font-semibold text-slate-900 dark:text-white">
                                            ${{ number_format((float) $quotation->total, 2) }}
                                        </span>
                                    </td>

                                    {{-- FECHA DE COTIZACIÓN --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $quotation->fecha_creacion?->format('d/m/Y') ?? '—' }}
                                    </td>

                                    {{-- VENCIMIENTO --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $quotation->fecha_vencimiento?->format('d/m/Y') ?? 'Sin vencimiento' }}
                                    </td>

                                    {{-- FECHA DE REGISTRO --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $quotation->created_at?->format('d/m/Y H:i') ?? '—' }}
                                    </td>

                                    {{-- ACCIONES --}}
                                    <td class="px-6 py-5">
                                        <div class="flex items-center justify-end gap-1">

                                            {{-- VER --}}
                                            <a
                                                href="{{ route('quotations.show', $quotation) }}"
                                                title="Ver cotización"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-cyan-600 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-cyan-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z"
                                                    />
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="2.75"
                                                    />
                                                </svg>
                                            </a>

                                            {{-- EDITAR --}}
                                            <a
                                                href="{{ route('quotations.edit', $quotation) }}"
                                                title="Editar cotización"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-blue-600 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-blue-400"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 0 1 2.652 2.652l-9.193 9.193a4.5 4.5 0 0 1-1.897 1.13l-2.28.684.684-2.28a4.5 4.5 0 0 1 1.13-1.897l7.217-7.794Z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19.5 13.5V19.125A2.625 2.625 0 0 1 16.875 21.75H5.625A2.625 2.625 0 0 1 3 19.125V7.875A2.625 2.625 0 0 1 5.625 5.25H11.25"
                                                    />
                                                </svg>
                                            </a>

                                            {{-- ELIMINAR --}}
                                            <form
                                                action="{{ route('quotations.destroy', $quotation) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar esta cotización?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Eliminar cotización"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-red-50 hover:text-red-600 dark:text-slate-400 dark:hover:bg-red-900/20 dark:hover:text-red-400"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M6 7.5h12M9.75 7.5V5.625A1.125 1.125 0 0 1 10.875 4.5h2.25a1.125 1.125 0 0 1 1.125 1.125V7.5m2.25 0v11.25A1.125 1.125 0 0 1 15.375 19.875h-6.75A1.125 1.125 0 0 1 7.5 18.75V7.5m3 3.375v5.625m3-5.625v5.625"
                                                        />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="6"
                                        class="px-6 py-14 text-center"
                                    >
                                        <div class="flex flex-col items-center justify-center">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="mb-3 h-10 w-10 text-slate-300 dark:text-slate-600"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M9 14.25 12 17.25l3-3m-8.25 3.75h10.5A2.25 2.25 0 0 0 19.5 15.75V8.25A2.25 2.25 0 0 0 17.25 6H6.75A2.25 2.25 0 0 0 4.5 8.25v7.5A2.25 2.25 0 0 0 6.75 18Z"
                                                />
                                            </svg>

                                            <p class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                                Ningún dato disponible en esta tabla
                                            </p>

                                        </div>
                                    </td>
                                </tr>

                            @endforelse

                            {{-- SIN RESULTADOS DE BÚSQUEDA --}}
                            <tr
                                x-show="search !== '' && visibleCount === 0"
                                x-cloak
                            >
                                <td
                                    colspan="6"
                                    class="px-6 py-14 text-center"
                                >
                                    <div class="flex flex-col items-center justify-center">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="mb-3 h-10 w-10 text-slate-300 dark:text-slate-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 1 1-13.5 0 6.75 6.75 0 0 1 13.5 0Z"
                                            />
                                        </svg>

                                        <p class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                            No se encontraron cotizaciones
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                            Intenta con otro cliente o folio.
                                        </p>

                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

                {{-- PAGINACIÓN --}}
                @if ($quotations->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-800">
                        {{ $quotations->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- ESTILOS DE IMPRESIÓN --}}
    <style>
        @media print {
            body {
                background: white !important;
            }

            nav,
            header,
            button,
            a,
            form,
            .print-hidden {
                display: none !important;
            }

            #quotationsTable {
                width: 100% !important;
                min-width: 0 !important;
                border-collapse: collapse !important;
            }

            #quotationsTable th,
            #quotationsTable td {
                border: 1px solid #d1d5db !important;
                padding: 8px !important;
                color: #000 !important;
                background: white !important;
            }

            #quotationsTable th {
                font-weight: 700 !important;
            }
        }
    </style>

    {{-- FUNCIONES DE EXPORTACIÓN --}}
    <script>
        function getQuotationRows() {
            const rows = document.querySelectorAll(
                '#quotationsTable tbody tr[data-search]:not(.hidden)'
            );

            return Array.from(rows);
        }

        function getQuotationData() {
            return getQuotationRows().map(row => {
                const cells = row.querySelectorAll('td');

                return {
                    cliente: cells[0]?.innerText.trim() ?? '',
                    total: cells[1]?.innerText.trim() ?? '',
                    fechaCotizacion: cells[2]?.innerText.trim() ?? '',
                    vencimiento: cells[3]?.innerText.trim() ?? '',
                    fechaRegistro: cells[4]?.innerText.trim() ?? '',
                };
            });
        }

        function printTable() {
            window.print();
        }

        function exportExcel() {
            const rows = getQuotationData();

            let csv = '\ufeff';

            csv += 'Cliente,Total,Fecha de Cotización,Vencimiento,Fecha de registro\n';

            rows.forEach(row => {
                csv += [
                    `"${row.cliente.replace(/"/g, '""')}"`,
                    `"${row.total.replace(/"/g, '""')}"`,
                    `"${row.fechaCotizacion.replace(/"/g, '""')}"`,
                    `"${row.vencimiento.replace(/"/g, '""')}"`,
                    `"${row.fechaRegistro.replace(/"/g, '""')}"`
                ].join(',');

                csv += '\n';
            });

            const blob = new Blob(
                [csv],
                {
                    type: 'text/csv;charset=utf-8;'
                }
            );

            const url = URL.createObjectURL(blob);

            const link = document.createElement('a');

            link.href = url;
            link.download = 'cotizaciones.csv';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            URL.revokeObjectURL(url);
        }

        function exportPDF() {
            const rows = getQuotationData();

            const printWindow = window.open('', '_blank');

            if (!printWindow) {
                alert('Permite las ventanas emergentes para generar el PDF.');
                return;
            }

            let tableRows = '';

            rows.forEach(row => {
                tableRows += `
                    <tr>
                        <td>${escapeHtml(row.cliente)}</td>
                        <td>${escapeHtml(row.total)}</td>
                        <td>${escapeHtml(row.fechaCotizacion)}</td>
                        <td>${escapeHtml(row.vencimiento)}</td>
                        <td>${escapeHtml(row.fechaRegistro)}</td>
                    </tr>
                `;
            });

            printWindow.document.write(`
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">

                    <title>Cotizaciones</title>

                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 40px;
                            color: #111827;
                        }

                        h1 {
                            margin-bottom: 5px;
                            font-size: 24px;
                        }

                        p {
                            margin-top: 0;
                            color: #6b7280;
                        }

                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 25px;
                        }

                        th,
                        td {
                            border: 1px solid #d1d5db;
                            padding: 10px;
                            text-align: left;
                            font-size: 12px;
                        }

                        th {
                            background: #f1f5f9;
                            font-weight: bold;
                        }

                        @media print {
                            body {
                                margin: 20px;
                            }
                        }
                    </style>
                </head>

                <body>

                    <h1>Cotizaciones</h1>

                    <p>
                        Listado de cotizaciones
                    </p>

                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Fecha de Cotización</th>
                                <th>Vencimiento</th>
                                <th>Fecha de registro</th>
                            </tr>
                        </thead>

                        <tbody>
                            ${tableRows}
                        </tbody>
                    </table>

                </body>
                </html>
            `);

            printWindow.document.close();

            printWindow.focus();

            setTimeout(() => {
                printWindow.print();
            }, 500);
        }

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }
    </script>
</x-app-layout>