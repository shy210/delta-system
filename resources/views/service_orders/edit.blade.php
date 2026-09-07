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
                        Editar orden #{{ $serviceOrder->id }}
                    </h1>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Actualiza la información registrada de esta orden de servicio.
                    </p>
                </div>

                <a
                    href="{{ route('service-orders.show', $serviceOrder) }}"
                    class="inline-flex w-fit items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
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

                    Volver a la orden
                </a>

            </div>


            {{-- Errores --}}
            @if($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 dark:border-red-900/50 dark:bg-red-950/30">

                    <div class="flex gap-3">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.007v.007H12v-.007z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10.29 3.86l-8.18 14.25A1.5 1.5 0 003.41 20.25h17.18a1.5 1.5 0 001.3-2.14L13.71 3.86a1.5 1.5 0 00-2.6 0z"
                            />
                        </svg>

                        <div>
                            <p class="font-semibold text-red-700 dark:text-red-300">
                                Revisa la información
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600 dark:text-red-400">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('service-orders.update', $serviceOrder) }}"
                id="service-order-edit-form"
            >

                @csrf
                @method('PUT')


                {{-- Cliente --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

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
                                Cliente asociado a la orden.
                            </p>
                        </div>

                    </div>


                    <div class="mt-6">

                        <label
                            for="customer_id"
                            class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                        >
                            Cliente
                        </label>

                        <select
                            name="customer_id"
                            id="customer_id"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                        >

                            <option value="">
                                Selecciona un cliente
                            </option>

                            @foreach($customers as $customer)

                                <option
                                    value="{{ $customer->id }}"
                                    @selected(old('customer_id', $serviceOrder->customer_id) == $customer->id)
                                >
                                    {{ $customer->nombre }}
                                    {{ $customer->apellido_paterno }}
                                    {{ $customer->apellido_materno }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </section>


                {{-- Equipo --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

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
                                Datos del dispositivo.
                            </p>
                        </div>

                    </div>


                    <div class="mt-6 grid gap-6 md:grid-cols-2">

                        <div>
                            <label
                                for="tipo_equipo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Tipo de equipo
                            </label>

                            <select
                                name="tipo_equipo"
                                id="tipo_equipo"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                                @foreach(['Celular', 'Laptop', 'Tablet', 'PC'] as $tipo)
                                    <option
                                        value="{{ $tipo }}"
                                        @selected(old('tipo_equipo', $serviceOrder->device?->tipo_equipo) === $tipo)
                                    >
                                        {{ $tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div>
                            <label
                                for="imei_numero_serie"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                IMEI / número de serie
                            </label>

                            <input
                                type="text"
                                name="imei_numero_serie"
                                id="imei_numero_serie"
                                value="{{ old('imei_numero_serie', $serviceOrder->device?->imei_numero_serie) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>


                        <div>
                            <label
                                for="marca"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Marca
                            </label>

                            <input
                                type="text"
                                name="marca"
                                id="marca"
                                required
                                value="{{ old('marca', $serviceOrder->device?->marca) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>


                        <div>
                            <label
                                for="modelo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Modelo
                            </label>

                            <input
                                type="text"
                                name="modelo"
                                id="modelo"
                                required
                                value="{{ old('modelo', $serviceOrder->device?->modelo) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>


                        <div>
                            <label
                                for="color"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Color
                            </label>

                            <input
                                type="text"
                                name="color"
                                id="color"
                                value="{{ old('color', $serviceOrder->device?->color) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>

                    </div>

                </section>


                {{-- Seguridad --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Seguridad del equipo
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Actualiza el método de bloqueo del dispositivo.
                    </p>


                    <div class="mt-6 grid gap-6 md:grid-cols-2">

                        <div>
                            <label
                                for="tipo_bloqueo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Tipo de bloqueo
                            </label>

                            <select
                                name="tipo_bloqueo"
                                id="tipo_bloqueo"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >

                                <option value="">
                                    Sin bloqueo
                                </option>

                                @foreach(['PIN', 'Contraseña', 'Patrón'] as $tipo)
                                    <option
                                        value="{{ $tipo }}"
                                        @selected(old('tipo_bloqueo', $serviceOrder->device?->tipo_bloqueo) === $tipo)
                                    >
                                        {{ $tipo }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div>
                            <label
                                for="dato_bloqueo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                PIN / contraseña
                            </label>

                            <input
                                type="text"
                                name="dato_bloqueo"
                                id="dato_bloqueo"
                                value="{{ old('dato_bloqueo', $serviceOrder->device?->tipo_bloqueo !== 'Patrón' ? $serviceOrder->device?->dato_bloqueo : '') }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>


                        <div>
                            <label
                                for="tamano_patron"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Tamaño del patrón
                            </label>

                            <select
                                name="tamano_patron"
                                id="tamano_patron"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >

                                <option value="">
                                    No aplica
                                </option>

                                <option
                                    value="3x3"
                                    @selected(old('tamano_patron', $serviceOrder->device?->tamano_patron) === '3x3')
                                >
                                    3 × 3
                                </option>

                                <option
                                    value="4x4"
                                    @selected(old('tamano_patron', $serviceOrder->device?->tamano_patron) === '4x4')
                                >
                                    4 × 4
                                </option>

                            </select>
                        </div>

                    </div>

                    @if($serviceOrder->device?->tipo_bloqueo === 'Patrón')

                        <div class="mt-5 rounded-xl bg-slate-50 p-4 text-sm text-slate-600 dark:bg-slate-800 dark:text-slate-300">

                            El patrón registrado actualmente se conserva si no modificas este apartado.

                        </div>

                    @endif

                </section>


                {{-- Condiciones --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Condiciones del equipo
                    </h2>

                    <div class="mt-6 space-y-6">

                        <div>
                            <label
                                for="condiciones_equipo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Condiciones del equipo
                            </label>

                            <textarea
                                name="condiciones_equipo"
                                id="condiciones_equipo"
                                rows="4"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >{{ old('condiciones_equipo', $serviceOrder->device?->condiciones_equipo) }}</textarea>
                        </div>


                        <div>
                            <label
                                for="accesorios_entregados"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Accesorios entregados
                            </label>

                            <textarea
                                name="accesorios_entregados"
                                id="accesorios_entregados"
                                rows="3"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >{{ old('accesorios_entregados', $serviceOrder->device?->accesorios_entregados) }}</textarea>
                        </div>


                        <div>
                            <label
                                for="estado_general"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Estado general
                            </label>

                            <select
                                name="estado_general"
                                id="estado_general"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >

                                @foreach(['Bueno', 'Regular', 'Malo'] as $estado)
                                    <option
                                        value="{{ $estado }}"
                                        @selected(old('estado_general', $serviceOrder->device?->estado_general) === $estado)
                                    >
                                        {{ $estado }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div>
                            <label
                                for="observaciones"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Observaciones
                            </label>

                            <textarea
                                name="observaciones"
                                id="observaciones"
                                rows="3"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >{{ old('observaciones', $serviceOrder->device?->observaciones) }}</textarea>
                        </div>

                    </div>

                </section>


                {{-- Servicio --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Servicio
                    </h2>

                    <div class="mt-6 space-y-6">

                        <div>
                            <label
                                for="problema_reportado"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Problema reportado
                            </label>

                            <textarea
                                name="problema_reportado"
                                id="problema_reportado"
                                rows="4"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >{{ old('problema_reportado', $serviceOrder->problema_reportado) }}</textarea>
                        </div>


                        <div>
                            <label
                                for="solucion"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Solución
                            </label>

                            <textarea
                                name="solucion"
                                id="solucion"
                                rows="4"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >{{ old('solucion', $serviceOrder->solucion) }}</textarea>
                        </div>


                        <div>
                            <label
                                for="revisado_anteriormente"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                ¿Fue revisado anteriormente?
                            </label>

                            <select
                                name="revisado_anteriormente"
                                id="revisado_anteriormente"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >

                                <option
                                    value="1"
                                    @selected(old('revisado_anteriormente', $serviceOrder->revisado_anteriormente) == 1)
                                >
                                    Sí
                                </option>

                                <option
                                    value="0"
                                    @selected(old('revisado_anteriormente', $serviceOrder->revisado_anteriormente) == 0)
                                >
                                    No
                                </option>

                            </select>

                        </div>

                    </div>

                </section>


                {{-- Programación --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Programación
                    </h2>

                    <div class="mt-6 grid gap-6 md:grid-cols-2">

                        <div>
                            <label
                                for="fecha_reparacion_programada"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Fecha de reparación
                            </label>

                            <input
                                type="date"
                                name="fecha_reparacion_programada"
                                id="fecha_reparacion_programada"
                                value="{{ old('fecha_reparacion_programada', optional($serviceOrder->fecha_reparacion_programada)->format('Y-m-d')) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>


                        <div>
                            <label
                                for="fecha_entrega_prometida"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Fecha de entrega prometida
                            </label>

                            <input
                                type="date"
                                name="fecha_entrega_prometida"
                                id="fecha_entrega_prometida"
                                value="{{ old('fecha_entrega_prometida', optional($serviceOrder->fecha_entrega_prometida)->format('Y-m-d')) }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>


                        <div>
                            <label
                                for="hora_entrega_prometida"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Hora de entrega
                            </label>

                            <input
                                type="time"
                                name="hora_entrega_prometida"
                                id="hora_entrega_prometida"
                                value="{{ old('hora_entrega_prometida', $serviceOrder->hora_entrega_prometida ? substr($serviceOrder->hora_entrega_prometida, 0, 5) : '') }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >
                        </div>


                        <div>
                            <label
                                for="branch_id"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Sucursal
                            </label>

                            <select
                                name="branch_id"
                                id="branch_id"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >

                                @foreach($branches as $branch)

                                    <option
                                        value="{{ $branch->id }}"
                                        @selected(old('branch_id', $serviceOrder->branch_id) == $branch->id)
                                    >
                                        {{ $branch->nombre }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </section>


                {{-- Firma --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Firma del cliente
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        La firma registrada se conserva mientras no se modifique.
                    </p>

                    @if($serviceOrder->firma)

                        <div class="mt-5 rounded-xl border border-slate-200 bg-white p-5 dark:border-slate-700 dark:bg-slate-950">

                            <img
                                src="{{ $serviceOrder->firma }}"
                                alt="Firma registrada"
                                class="mx-auto max-h-40 max-w-full object-contain"
                            >

                        </div>

                    @else

                        <div class="mt-5 rounded-xl bg-slate-50 p-5 text-sm text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                            No hay una firma registrada para esta orden.
                        </div>

                    @endif

                    <input
                        type="hidden"
                        name="firma"
                        value="{{ old('firma', $serviceOrder->firma) }}"
                    >

                </section>


                {{-- Costos --}}
                <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Información económica
                    </h2>

                    <div class="mt-6 grid gap-6 md:grid-cols-3">

                        <div>
                            <label
                                for="costo_total"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Costo total
                            </label>

                            <div class="relative mt-2">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                    $
                                </span>

                                <input
                                    type="number"
                                    name="costo_total"
                                    id="costo_total"
                                    step="0.01"
                                    min="0"
                                    required
                                    value="{{ old('costo_total', $serviceOrder->costo_total) }}"
                                    class="block w-full rounded-xl border-slate-300 bg-white pl-8 text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                                >

                            </div>
                        </div>


                        <div>
                            <label
                                for="anticipo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Anticipo
                            </label>

                            <div class="relative mt-2">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                                    $
                                </span>

                                <input
                                    type="number"
                                    name="anticipo"
                                    id="anticipo"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('anticipo', $serviceOrder->anticipo) }}"
                                    class="block w-full rounded-xl border-slate-300 bg-white pl-8 text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                                >

                            </div>
                        </div>


                        <div>
                            <label
                                for="tiene_garantia"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                ¿Tiene garantía?
                            </label>

                            <select
                                name="tiene_garantia"
                                id="tiene_garantia"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100"
                            >

                                <option
                                    value="1"
                                    @selected(old('tiene_garantia', $serviceOrder->tiene_garantia) == 1)
                                >
                                    Sí
                                </option>

                                <option
                                    value="0"
                                    @selected(old('tiene_garantia', $serviceOrder->tiene_garantia) == 0)
                                >
                                    No
                                </option>

                            </select>

                        </div>

                    </div>

                </section>


                {{-- Botones --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('service-orders.show', $serviceOrder) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950"
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
                                d="M5 12.5l4 4L19 6.5"
                            />
                        </svg>

                        Guardar cambios

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>