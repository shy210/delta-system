<x-app-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 dark:bg-slate-950 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl">

            {{-- Encabezado --}}
            <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

                <div>
                    <p class="mb-2 text-sm font-semibold uppercase tracking-[0.18em] text-cyan-600 dark:text-cyan-400">
                        Mi taller
                    </p>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                        Orden #{{ $serviceOrder->id }}
                    </h1>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Consulta toda la información registrada de esta orden de servicio.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">

                    {{-- Editar --}}
                    <a
                        href="{{ route('service-orders.edit', $serviceOrder) }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-cyan-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-600"
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
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 7.125L16.875 4.5"
                            />
                        </svg>

                        Editar
                    </a>

                    {{-- Volver --}}
                    <a
                        href="{{ route('service-orders.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
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
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                            />
                        </svg>

                        Volver
                    </a>

                </div>
            </div>


            {{-- Estado de la orden --}}
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">
                            Orden de servicio
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                            #{{ $serviceOrder->id }}
                        </h2>
                    </div>

                    @php
                        $estado = strtolower($serviceOrder->estado);

                        $estadoClasses = match ($estado) {
                            'recibida' =>
                                'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300',

                            'en_revision' =>
                                'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300',

                            'en_reparacion' =>
                                'bg-cyan-100 text-cyan-700 dark:bg-cyan-950/40 dark:text-cyan-300',

                            'lista' =>
                                'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300',

                            'entregada' =>
                                'bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300',

                            'cancelada' =>
                                'bg-red-100 text-red-700 dark:bg-red-950/40 dark:text-red-300',

                            default =>
                                'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300',
                        };
                    @endphp

                    <span class="inline-flex w-fit rounded-full px-3 py-1.5 text-sm font-semibold {{ $estadoClasses }}">
                        {{ ucfirst(str_replace('_', ' ', $serviceOrder->estado)) }}
                    </span>

                </div>

            </div>


            {{-- Información principal --}}
            <div class="grid gap-6 lg:grid-cols-2">


                {{-- Cliente --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400">

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
                                    d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 20.25a8.25 8.25 0 0115 0"
                                />
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                                Cliente
                            </h2>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Información de contacto
                            </p>
                        </div>

                    </div>


                    <div class="mt-6 space-y-5">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Nombre completo
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $serviceOrder->customer->nombre }}
                                {{ $serviceOrder->customer->apellido_paterno }}
                                {{ $serviceOrder->customer->apellido_materno }}
                            </p>
                        </div>


                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Teléfono
                                </p>

                                <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                    {{ $serviceOrder->customer->telefono ?: 'No registrado' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    WhatsApp
                                </p>

                                <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                    {{ $serviceOrder->customer->whatsapp ?: 'No registrado' }}
                                </p>
                            </div>

                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Correo
                            </p>

                            <p class="mt-1 break-all text-sm text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->customer->correo ?: 'No registrado' }}
                            </p>
                        </div>

                    </div>

                </section>


                {{-- Equipo --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="5"
                                    y="3"
                                    width="14"
                                    height="18"
                                    rx="2"
                                />
                                <path
                                    stroke-linecap="round"
                                    d="M9 18h6"
                                />
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                                Equipo
                            </h2>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Datos del dispositivo recibido
                            </p>
                        </div>

                    </div>


                    <div class="mt-6 grid gap-5 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Tipo
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $serviceOrder->device->tipo_equipo }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Marca
                            </p>

                            <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->device->marca }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Modelo
                            </p>

                            <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->device->modelo }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Color
                            </p>

                            <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->device->color ?: 'No especificado' }}
                            </p>
                        </div>


                        <div class="sm:col-span-2">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                IMEI / número de serie
                            </p>

                            <p class="mt-1 break-all text-sm text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->device->imei_numero_serie ?: 'No especificado' }}
                            </p>
                        </div>

                    </div>

                </section>


                {{-- Seguridad del equipo --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Seguridad del equipo
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Información de bloqueo registrada.
                    </p>


                    <div class="mt-6 grid gap-5 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Tipo de bloqueo
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $serviceOrder->device->tipo_bloqueo ?: 'Sin bloqueo registrado' }}
                            </p>
                        </div>


                        @if($serviceOrder->device->tipo_bloqueo === 'Patrón')

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Tamaño del patrón
                                </p>

                                <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                    {{ $serviceOrder->device->tamano_patron ?: 'No especificado' }}
                                </p>
                            </div>

                        @endif


                        @if($serviceOrder->device->dato_bloqueo)

                            <div class="sm:col-span-2">

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Datos de bloqueo
                                </p>

                                <div class="mt-2 rounded-xl bg-slate-50 px-4 py-3 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                    {{ $serviceOrder->device->dato_bloqueo }}
                                </div>

                            </div>

                        @endif

                    </div>

                </section>


                {{-- Condiciones --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Condiciones del equipo
                    </h2>

                    <div class="mt-6 space-y-5">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Condiciones
                            </p>

                            <p class="mt-2 text-sm leading-6 text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->device->condiciones_equipo }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Estado general
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $serviceOrder->device->estado_general }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Accesorios entregados
                            </p>

                            <p class="mt-2 text-sm leading-6 text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->device->accesorios_entregados ?: 'Ninguno registrado.' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Observaciones
                            </p>

                            <p class="mt-2 text-sm leading-6 text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->device->observaciones ?: 'Sin observaciones.' }}
                            </p>
                        </div>

                    </div>

                </section>


                {{-- Servicio --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Servicio
                    </h2>

                    <div class="mt-6 space-y-6">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Problema reportado
                            </p>

                            <div class="mt-2 rounded-xl bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                {{ $serviceOrder->problema_reportado }}
                            </div>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Solución
                            </p>

                            <div class="mt-2 rounded-xl bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                {{ $serviceOrder->solucion ?: 'Pendiente.' }}
                            </div>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                ¿Fue revisado anteriormente?
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $serviceOrder->revisado_anteriormente ? 'Sí' : 'No' }}
                            </p>
                        </div>

                    </div>

                </section>


                {{-- Fechas --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Programación
                    </h2>

                    <div class="mt-6 space-y-5">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Sucursal
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $serviceOrder->branch->nombre }}
                            </p>
                        </div>


                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Reparación programada
                                </p>

                                <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                    {{ $serviceOrder->fecha_reparacion_programada?->format('d/m/Y') ?? 'No definida' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Entrega prometida
                                </p>

                                <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                    {{ $serviceOrder->fecha_entrega_prometida?->format('d/m/Y') ?? 'No definida' }}
                                </p>
                            </div>

                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Hora de entrega
                            </p>

                            <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">
                                {{ $serviceOrder->hora_entrega_prometida
                                    ? substr($serviceOrder->hora_entrega_prometida, 0, 5)
                                    : 'No definida' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Garantía
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                                {{ $serviceOrder->tiene_garantia ? 'Sí' : 'No' }}
                            </p>
                        </div>

                    </div>

                </section>


                {{-- Información económica --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 lg:col-span-2">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Información económica
                    </h2>

                    <div class="mt-6 grid gap-6 sm:grid-cols-3">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Costo total
                            </p>

                            <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                                ${{ number_format($serviceOrder->costo_total, 2) }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Anticipo
                            </p>

                            <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                                ${{ number_format($serviceOrder->anticipo, 2) }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Saldo pendiente
                            </p>

                            <p class="mt-2 text-2xl font-bold text-cyan-600 dark:text-cyan-400">
                                ${{ number_format(max(0, $serviceOrder->costo_total - $serviceOrder->anticipo), 2) }}
                            </p>
                        </div>

                    </div>

                </section>

            </div>


            {{-- Firma --}}
            @if($serviceOrder->firma)

                <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Firma registrada
                    </h2>

                    <div class="mt-5 rounded-xl border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-950">

                        <img
                            src="{{ $serviceOrder->firma }}"
                            alt="Firma del cliente"
                            class="mx-auto max-h-40 max-w-full object-contain"
                        >

                    </div>

                </section>

            @endif


            {{-- Zona de eliminación --}}
            <div class="mt-8 flex justify-end">

                <form
                    method="POST"
                    action="{{ route('service-orders.destroy', $serviceOrder) }}"
                    onsubmit="return confirm('¿Seguro que deseas eliminar esta orden de servicio? Esta acción no se puede deshacer.');"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-red-500 transition hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
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
                                d="M6 7h12M9 7V4h6v3m-8 0l.75 13.5h6.5L15 7M10 11v6M14 11v6"
                            />
                        </svg>

                        Eliminar orden

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>