
<x-app-layout>

    <div
        x-data="{
            search: '',

            filterOrders() {
                const rows = document.querySelectorAll('.service-order-row');
                let visible = 0;

                rows.forEach(row => {
                    const searchText = row.dataset.search || '';

                    const matchesSearch =
                        this.search.trim() === '' ||
                        searchText.includes(this.search.toLowerCase().trim());

                    row.classList.toggle('hidden', !matchesSearch);

                    if (matchesSearch) {
                        visible++;
                    }
                });

                const counter = document.getElementById('visible-count');
                const label = document.getElementById('visible-label');
                const noResults = document.getElementById('no-results');

                if (counter) {
                    counter.textContent = visible;
                }

                if (label) {
                    label.textContent = visible === 1
                        ? 'orden encontrada'
                        : 'órdenes encontradas';
                }

                if (noResults) {
                    noResults.classList.toggle('hidden', visible !== 0);
                }
            }
        }"
        x-init="$nextTick(() => filterOrders())"
        class="min-h-screen bg-slate-50 py-8 transition-colors duration-300 dark:bg-slate-950"
    >

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- =========================================================
                ENCABEZADO
            ========================================================== --}}
            <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div class="mb-3 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"></span>

                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-cyan-600 dark:text-cyan-400">
                            Operación del taller
                        </p>

                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Mi taller
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                        Administra y da seguimiento a las órdenes de servicio de tu taller.
                    </p>

                </div>


                {{-- =====================================================
                    NUEVA ORDEN
                ====================================================== --}}
                <a
                    href="{{ route('service-orders.create') }}"
                    class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition-all duration-200 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400 sm:w-auto"
                >

                    <svg
                        class="h-5 w-5 transition-transform duration-200 group-hover:rotate-90"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Nueva orden

                </a>

            </div>


            {{-- =========================================================
                ALERTA DE ÉXITO
            ========================================================== --}}
            @if (session('success'))

                <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-sm text-emerald-800 dark:border-emerald-900/60 dark:bg-emerald-950/30 dark:text-emerald-300">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- =========================================================
                BUSCADOR
            ========================================================== --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="relative w-full sm:max-w-md">

                    <svg
                        class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z"
                        />
                    </svg>

                    <input
                        type="text"
                        x-model="search"
                        @input="filterOrders()"
                        placeholder="Buscar cliente, equipo, IMEI..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-800 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500"
                    />

                </div>


                <p class="text-xs text-slate-400">

                    <span id="visible-count">
                        {{ $serviceOrders->count() }}
                    </span>

                    <span id="visible-label">
                        {{ $serviceOrders->count() === 1 ? 'orden encontrada' : 'órdenes encontradas' }}
                    </span>

                </p>

            </div>


            {{-- =========================================================
                LISTADO
            ========================================================== --}}
            @if ($serviceOrders->count())

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    @foreach ($serviceOrders as $serviceOrder)

                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | NOMBRE DEL CLIENTE
                            |--------------------------------------------------------------------------
                            */

                            $customerName = trim(
                                ($serviceOrder->customer->nombre ?? '') . ' ' .
                                ($serviceOrder->customer->apellido_paterno ?? '') . ' ' .
                                ($serviceOrder->customer->apellido_materno ?? '')
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | NOMBRE DEL EQUIPO
                            |--------------------------------------------------------------------------
                            */

                            $deviceName = trim(
                                ($serviceOrder->device->marca ?? '') . ' ' .
                                ($serviceOrder->device->modelo ?? '')
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | ESTADO
                            |--------------------------------------------------------------------------
                            */

                            $status = $serviceOrder->estado ?? 'recibida';

                            $statusLabels = [
                                'recibida' => 'Recibida',
                                'en_revision' => 'En revisión',
                                'en_reparacion' => 'En reparación',
                                'lista' => 'Lista',
                                'entregada' => 'Entregada',
                                'cancelada' => 'Cancelada',
                            ];


                            $statusClasses = [
                                'recibida' =>
                                    'bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300',

                                'en_revision' =>
                                    'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300',

                                'en_reparacion' =>
                                    'bg-cyan-50 text-cyan-700 dark:bg-cyan-950/40 dark:text-cyan-300',

                                'lista' =>
                                    'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300',

                                'entregada' =>
                                    'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300',

                                'cancelada' =>
                                    'bg-red-50 text-red-700 dark:bg-red-950/40 dark:text-red-300',
                            ];


                            /*
                            |--------------------------------------------------------------------------
                            | DATOS PARA BÚSQUEDA
                            |--------------------------------------------------------------------------
                            */

                            $searchData = strtolower(
                                '#' . $serviceOrder->id . ' ' .
                                $customerName . ' ' .
                                ($serviceOrder->customer->correo ?? '') . ' ' .
                                ($serviceOrder->customer->telefono ?? '') . ' ' .
                                $deviceName . ' ' .
                                ($serviceOrder->device->tipo_equipo ?? '') . ' ' .
                                ($serviceOrder->device->imei_numero_serie ?? '') . ' ' .
                                ($serviceOrder->branch->nombre ?? '')
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | SALDO
                            |--------------------------------------------------------------------------
                            */

                            $saldo = max(
                                0,
                                (float) $serviceOrder->costo_total -
                                (float) $serviceOrder->anticipo
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | INICIALES
                            |--------------------------------------------------------------------------
                            */

                            $initials = '';

                            if ($customerName) {

                                $parts = preg_split('/\s+/', $customerName);

                                $initials = strtoupper(
                                    substr($parts[0] ?? '', 0, 1) .
                                    substr($parts[1] ?? '', 0, 1)
                                );
                            }

                            $initials = $initials ?: 'CL';

                        @endphp


                        {{-- =================================================
                            ORDEN DE SERVICIO
                        ================================================== --}}
                        <article
                            class="service-order-row group border-b border-slate-100 transition-colors duration-200 last:border-b-0 hover:bg-slate-50/80 dark:border-slate-800 dark:hover:bg-slate-800/30"
                            data-search="{{ $searchData }}"
                        >

                            <div class="p-5 sm:p-6">

                                <div class="flex flex-col gap-5 lg:flex-row lg:items-center">


                                    {{-- =================================================
                                        CLIENTE Y EQUIPO
                                    ================================================== --}}
                                    <div class="flex min-w-0 flex-1 items-start gap-4">

                                        {{-- Avatar --}}
                                        <div class="relative shrink-0">

                                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                                {{ $initials }}
                                            </div>

                                            <span class="absolute -bottom-1 -right-1 h-3 w-3 rounded-full border-2 border-white bg-cyan-500 dark:border-slate-900"></span>

                                        </div>


                                        {{-- Información --}}
                                        <div class="min-w-0">

                                            <div class="flex flex-wrap items-center gap-2">

                                                <span class="text-xs font-semibold text-cyan-600 dark:text-cyan-400">
                                                    #{{ str_pad($serviceOrder->id, 5, '0', STR_PAD_LEFT) }}
                                                </span>

                                                <span class="text-slate-300 dark:text-slate-700">
                                                    /
                                                </span>

                                                <h3 class="truncate text-sm font-bold text-slate-900 dark:text-white sm:text-base">
                                                    {{ $customerName ?: 'Cliente sin nombre' }}
                                                </h3>

                                            </div>


                                            {{-- Equipo --}}
                                            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm">

                                                <span class="font-medium text-slate-700 dark:text-slate-200">
                                                    {{ $deviceName ?: 'Equipo no especificado' }}
                                                </span>


                                                @if ($serviceOrder->device?->tipo_equipo)

                                                    <span class="text-slate-400">
                                                        {{ $serviceOrder->device->tipo_equipo }}
                                                    </span>

                                                @endif


                                                @if ($serviceOrder->device?->color)

                                                    <span class="text-slate-400">
                                                        {{ $serviceOrder->device->color }}
                                                    </span>

                                                @endif

                                            </div>


                                            {{-- Datos secundarios --}}
                                            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-400">

                                                @if ($serviceOrder->device?->imei_numero_serie)

                                                    <span>
                                                        IMEI/SN:
                                                        {{ $serviceOrder->device->imei_numero_serie }}
                                                    </span>

                                                @endif


                                                @if ($serviceOrder->branch)

                                                    <span>
                                                        {{ $serviceOrder->branch->nombre }}
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                    {{-- =================================================
                                        ESTADO
                                    ================================================== --}}
                                    <div class="lg:w-36 lg:text-center">

                                        <span
                                            class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-[11px] font-bold {{ $statusClasses[$status] ?? 'bg-slate-100 text-slate-600' }}"
                                        >

                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                                            {{ $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}

                                        </span>

                                    </div>


                                    {{-- =================================================
                                        ENTREGA Y COSTOS
                                    ================================================== --}}
                                    <div class="grid grid-cols-2 gap-6 border-t border-slate-100 pt-4 sm:grid-cols-3 lg:w-[390px] lg:border-l lg:border-t-0 lg:pl-6 lg:pt-0 dark:border-slate-800">


                                        {{-- Entrega --}}
                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Entrega
                                            </p>


                                            @if ($serviceOrder->fecha_entrega_prometida)

                                                <p class="mt-1 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                                    {{ $serviceOrder->fecha_entrega_prometida->format('d/m/Y') }}
                                                </p>


                                                @if ($serviceOrder->hora_entrega_prometida)

                                                    <p class="text-xs text-slate-400">
                                                        {{ \Carbon\Carbon::parse($serviceOrder->hora_entrega_prometida)->format('H:i') }}
                                                        h
                                                    </p>

                                                @endif

                                            @else

                                                <p class="mt-1 text-sm text-slate-400">
                                                    Pendiente
                                                </p>

                                            @endif

                                        </div>


                                        {{-- Total --}}
                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Total
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                                ${{ number_format((float) $serviceOrder->costo_total, 2) }}
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                Anticipo:
                                                ${{ number_format((float) $serviceOrder->anticipo, 2) }}
                                            </p>

                                        </div>


                                        {{-- Saldo --}}
                                        <div class="hidden sm:block">

                                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Saldo
                                            </p>

                                            <p
                                                class="mt-1 text-sm font-bold {{ $saldo > 0 ? 'text-slate-900 dark:text-white' : 'text-emerald-600 dark:text-emerald-400' }}"
                                            >
                                                ${{ number_format($saldo, 2) }}
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                {{ $saldo > 0 ? 'Pendiente' : 'Pagado' }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- =================================================
                                        ACCIONES
                                    ================================================== --}}
                                    <div class="flex shrink-0 items-center gap-1 border-t border-slate-100 pt-4 dark:border-slate-800 lg:border-0 lg:pt-0">


                                        {{-- VER --}}
                                        <a
                                            href="{{ route('service-orders.show', $serviceOrder) }}"
                                            title="Ver orden"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-cyan-50 hover:text-cyan-600 dark:hover:bg-cyan-950/30 dark:hover:text-cyan-400"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.5"
                                                    stroke-width="1.8"
                                                />

                                            </svg>

                                        </a>


                                        {{-- EDITAR --}}
                                        <a
                                            href="{{ route('service-orders.edit', $serviceOrder) }}"
                                            title="Editar orden"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L7 19l-4 1 1-4L16.5 3.5z"
                                                />
                                            </svg>

                                        </a>


                                        {{-- ELIMINAR --}}
                                        <form
                                            action="{{ route('service-orders.destroy', $serviceOrder) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar esta orden de servicio? Esta acción no se puede deshacer.');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Eliminar orden"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-950/30 dark:hover:text-red-400"
                                            >

                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M6 7h12M10 11v6M14 11v6M8 7l1-3h6l1 3M5 7l1 14h12l1-14"
                                                    />
                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>


                {{-- =========================================================
                    SIN RESULTADOS
                ========================================================== --}}
                <div
                    id="no-results"
                    class="hidden py-16 text-center"
                >

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-900 dark:text-slate-500">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z"
                            />
                        </svg>

                    </div>


                    <h3 class="mt-4 text-base font-bold text-slate-900 dark:text-white">
                        No encontramos órdenes
                    </h3>


                    <p class="mt-1 text-sm text-slate-400">
                        Prueba con otro cliente, equipo o IMEI.
                    </p>

                </div>

            @else


                {{-- =========================================================
                    SIN ÓRDENES
                ========================================================== --}}
                <div class="relative py-20 text-center">

                    <div class="pointer-events-none absolute left-1/2 top-1/2 h-64 w-64 -translate-x-1/2 -translate-y-1/2 rounded-full bg-cyan-400/5 blur-3xl dark:bg-cyan-400/10"></div>


                    <div class="relative">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-400 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:text-slate-500">

                            <svg
                                class="h-8 w-8"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M9 5h10M9 9h10M9 13h10M9 17h6M5 5h.01M5 9h.01M5 13h.01M5 17h.01"
                                />
                            </svg>

                        </div>


                        <h3 class="mt-5 text-lg font-bold text-slate-900 dark:text-white">
                            Aún no hay órdenes de servicio
                        </h3>


                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">
                            Registra el primer equipo recibido en el taller para comenzar a darle seguimiento.
                        </p>


                        <a
                            href="{{ route('service-orders.create') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Nueva orden

                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>