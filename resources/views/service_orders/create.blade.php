<x-app-layout>

    <div
        x-data="serviceOrderForm()"
        class="min-h-screen bg-slate-50 py-8 transition-colors duration-300 dark:bg-slate-950"
    >

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                ENCABEZADO
            ========================================================== --}}
            <div class="mb-8">

                <a
                    href="{{ route('service-orders.index') }}"
                    class="mb-5 inline-flex items-center gap-2 text-sm font-medium text-slate-400 transition hover:text-cyan-600 dark:hover:text-cyan-400"
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
                            d="M19 12H5M12 19l-7-7 7-7"
                        />
                    </svg>

                    Volver a órdenes
                </a>


                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <div class="mb-3 flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"></span>

                            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-cyan-600 dark:text-cyan-400">
                                Mi taller
                            </p>
                        </div>

                        <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                            Nueva orden de servicio
                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                            Registra el ingreso de un equipo y toda la información necesaria para darle seguimiento a su reparación.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                ERRORES
            ========================================================== --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 dark:border-red-900/60 dark:bg-red-950/20">

                    <div class="flex items-start gap-3">

                        <svg
                            class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 8v4m0 4h.01M10.3 3.8l-7.1 12.4A2 2 0 005 19h14a2 2 0 001.8-2.8L13.7 3.8a2 2 0 00-3.4 0z"
                            />
                        </svg>

                        <div>

                            <p class="text-sm font-bold text-red-800 dark:text-red-300">
                                Revisa la información ingresada
                            </p>

                            <ul class="mt-2 space-y-1 text-sm text-red-700 dark:text-red-400">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        • {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('service-orders.store') }}"
                id="service-order-form"
            >

                @csrf


                {{-- =====================================================
                    01. CLIENTE
                ====================================================== --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400">

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
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900 dark:text-white">
                                    Datos del cliente
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Selecciona un cliente registrado para cargar sus datos.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-5 sm:p-6">

                        {{-- Seleccionar cliente --}}
                        <div>

                            <label
                                for="customer_id"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Cliente
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="customer_id"
                                name="customer_id"
                                x-model="customerId"
                                @change="loadCustomer()"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >

                                <option value="">
                                    Selecciona un cliente
                                </option>

                                @foreach ($customers as $customer)

                                    @php
                                        $fullName = trim(
                                            $customer->nombre . ' ' .
                                            $customer->apellido_paterno . ' ' .
                                            $customer->apellido_materno
                                        );
                                    @endphp

                                    <option
                                        value="{{ $customer->id }}"
                                        data-nombre="{{ $customer->nombre }}"
                                        data-apellido-paterno="{{ $customer->apellido_paterno }}"
                                        data-apellido-materno="{{ $customer->apellido_materno }}"
                                        data-telefono="{{ $customer->telefono }}"
                                        data-correo="{{ $customer->correo }}"
                                        data-pais="{{ $customer->pais }}"
                                        data-whatsapp="{{ $customer->whatsapp }}"
                                        data-contacto-alternativo="{{ $customer->contacto_alternativo }}"
                                    >
                                        {{ $fullName }}
                                        @if ($customer->empresa)
                                            — {{ $customer->empresa }}
                                        @endif
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Datos cargados --}}
                        <div
                            x-show="customerId"
                            x-transition
                            class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3"
                        >

                            {{-- Nombre --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Nombre
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.nombre"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>


                            {{-- Apellido paterno --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Apellido paterno
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.apellido_paterno"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>


                            {{-- Apellido materno --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Apellido materno
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.apellido_materno"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>


                            {{-- Teléfono --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Teléfono
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.telefono"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>


                            {{-- Correo --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Correo
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.correo"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>


                            {{-- País --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    País
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.pais"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>


                            {{-- WhatsApp --}}
                            <div>

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    WhatsApp
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.whatsapp"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>


                            {{-- Contacto alternativo --}}
                            <div class="md:col-span-2">

                                <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Contacto alternativo
                                </label>

                                <input
                                    type="text"
                                    x-model="customer.contacto_alternativo"
                                    readonly
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-300"
                                />

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =====================================================
                    02. EQUIPO
                ====================================================== --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <rect
                                        x="6"
                                        y="2"
                                        width="12"
                                        height="20"
                                        rx="2"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-width="1.8"
                                        d="M10 18h4"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900 dark:text-white">
                                    Equipo recibido
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Registra las características del equipo que ingresa al taller.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">


                            {{-- Tipo de equipo --}}
                            <div>

                                <label
                                    for="tipo_equipo"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Tipo de equipo
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="tipo_equipo"
                                    name="tipo_equipo"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >

                                    <option value="">
                                        Selecciona una opción
                                    </option>

                                    <option value="Celular">
                                        Celular
                                    </option>

                                    <option value="Laptop">
                                        Laptop
                                    </option>

                                    <option value="Tablet">
                                        Tablet
                                    </option>

                                    <option value="PC">
                                        PC
                                    </option>

                                </select>

                            </div>


                            {{-- IMEI / Serie --}}
                            <div>

                                <label
                                    for="imei_numero_serie"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    IMEI / número de serie
                                </label>

                                <input
                                    id="imei_numero_serie"
                                    name="imei_numero_serie"
                                    type="text"
                                    value="{{ old('imei_numero_serie') }}"
                                    placeholder="Ej. 356789..."
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            {{-- Marca --}}
                            <div>

                                <label
                                    for="marca"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Marca
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    id="marca"
                                    name="marca"
                                    type="text"
                                    value="{{ old('marca') }}"
                                    required
                                    placeholder="Ej. Apple"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            {{-- Modelo --}}
                            <div>

                                <label
                                    for="modelo"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Modelo
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    id="modelo"
                                    name="modelo"
                                    type="text"
                                    value="{{ old('modelo') }}"
                                    required
                                    placeholder="Ej. iPhone 15"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            {{-- Color --}}
                            <div>

                                <label
                                    for="color"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Color
                                </label>

                                <input
                                    id="color"
                                    name="color"
                                    type="text"
                                    value="{{ old('color') }}"
                                    placeholder="Ej. Negro"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =====================================================
                    03. BLOQUEO
                ====================================================== --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <rect
                                        x="4"
                                        y="10"
                                        width="16"
                                        height="11"
                                        rx="2"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-width="1.8"
                                        d="M8 10V7a4 4 0 018 0v3"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900 dark:text-white">
                                    Bloqueo del equipo
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Registra el método de acceso necesario para realizar el servicio.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-5 sm:p-6">

                        <div class="max-w-md">

                            <label
                                for="tipo_bloqueo"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Tipo de bloqueo
                            </label>

                            <select
                                id="tipo_bloqueo"
                                name="tipo_bloqueo"
                                x-model="lockType"
                                @change="changeLockType()"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >

                                <option value="">
                                    Sin bloqueo / no especificado
                                </option>

                                <option value="PIN">
                                    PIN
                                </option>

                                <option value="Contraseña">
                                    Contraseña
                                </option>

                                <option value="Patrón">
                                    Patrón
                                </option>

                            </select>

                        </div>


                        {{-- PIN --}}
                        <div
                            x-show="lockType === 'PIN'"
                            x-transition
                            class="max-w-md"
                        >

                            <label
                                for="dato_bloqueo_pin"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Ingrese el PIN
                            </label>

                            <input
                                id="dato_bloqueo_pin"
                                name="dato_bloqueo"
                                x-bind:disabled="lockType !== 'PIN'"
                                type="password"
                                inputmode="numeric"
                                autocomplete="off"
                                placeholder="PIN del equipo"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            />

                        </div>


                        {{-- Contraseña --}}
                        <div
                            x-show="lockType === 'Contraseña'"
                            x-transition
                            class="max-w-md"
                        >

                            <label
                                for="dato_bloqueo_password"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Ingrese la contraseña
                            </label>

                            <input
                                id="dato_bloqueo_password"
                                name="dato_bloqueo"
                                x-bind:disabled="lockType !== 'Contraseña'"
                                type="password"
                                autocomplete="off"
                                placeholder="Contraseña del equipo"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            />

                        </div>


                        {{-- Patrón --}}
                        <div
                            x-show="lockType === 'Patrón'"
                            x-transition
                            class="grid grid-cols-1 gap-8 lg:grid-cols-[auto_1fr]"
                        >

                            <div>

                                <p class="mb-3 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Dibuje el patrón
                                </p>


                                <div class="relative">

                                    <canvas
                                        id="pattern-canvas"
                                        width="300"
                                        height="300"
                                        class="touch-none rounded-2xl border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-950"
                                    ></canvas>

                                </div>


                                <button
                                    type="button"
                                    @click="clearPattern()"
                                    class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-slate-400 transition hover:text-red-500"
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

                                    Limpiar patrón

                                </button>

                            </div>


                            <div class="max-w-sm">

                                <label
                                    for="tamano_patron"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Tamaño del patrón
                                </label>

                                <select
                                    id="tamano_patron"
                                    name="tamano_patron"
                                    x-model="patternSize"
                                    @change="initializePattern()"
                                    x-bind:disabled="lockType !== 'Patrón'"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >

                                    <option value="3x3">
                                        3 × 3
                                    </option>

                                    <option value="4x4">
                                        4 × 4
                                    </option>

                                </select>


                                <p class="mt-4 text-xs leading-5 text-slate-400">
                                    Selecciona los puntos en el orden en que el cliente realiza el patrón.
                                    El patrón se puede dibujar con mouse o pantalla táctil.
                                </p>


                                <input
                                    type="hidden"
                                    id="patron_datos"
                                    name="patron_datos"
                                    x-model="patternData"
                                />

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =====================================================
                    04. CONDICIONES
                ====================================================== --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

                        <div class="flex items-center justify-between gap-4">

                            <div class="flex items-center gap-4">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300">

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
                                            d="M4 7h16M4 12h16M4 17h10"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h2 class="text-base font-bold text-slate-900 dark:text-white">
                                        Condiciones del equipo
                                    </h2>

                                    <p class="mt-0.5 text-xs text-slate-400">
                                        Documenta cómo se recibe el equipo antes de iniciar el servicio.
                                    </p>

                                </div>

                            </div>


                            {{-- QR evidencia --}}
                            <button
                                type="button"
                                @click="showEvidenceInfo = true"
                                class="group inline-flex shrink-0 items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-cyan-300 hover:text-cyan-600 dark:border-slate-700 dark:text-slate-300 dark:hover:border-cyan-700 dark:hover:text-cyan-400"
                            >

                                <svg
                                    class="h-4 w-4 transition-transform group-hover:scale-105"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 4h6v6H4V4zM14 4h6v6h-6V4zM4 14h6v6H4v-6zM14 14h2v2h-2v-2zM18 14h2v2h-2v-2zM14 18h2v2h-2v-2zM18 18h2v2h-2v-2z"
                                    />
                                </svg>

                                Evidencia por QR

                            </button>

                        </div>

                    </div>


                    <div class="space-y-5 p-5 sm:p-6">


                        {{-- Condiciones --}}
                        <div>

                            <label
                                for="condiciones_equipo"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Condiciones del equipo
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea
                                id="condiciones_equipo"
                                name="condiciones_equipo"
                                rows="4"
                                required
                                placeholder="Describe golpes, rayones, pantalla, tapas, puertos, etc."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >{{ old('condiciones_equipo') }}</textarea>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                            {{-- Accesorios --}}
                            <div>

                                <label
                                    for="accesorios_entregados"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Accesorios entregados
                                </label>

                                <textarea
                                    id="accesorios_entregados"
                                    name="accesorios_entregados"
                                    rows="4"
                                    placeholder="Ej. Cargador, funda, cable USB..."
                                    class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >{{ old('accesorios_entregados') }}</textarea>

                            </div>


                            {{-- Estado general --}}
                            <div>

                                <label
                                    for="estado_general"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Estado general
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="estado_general"
                                    name="estado_general"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >

                                    <option value="">
                                        Selecciona una opción
                                    </option>

                                    <option value="Bueno">
                                        Bueno
                                    </option>

                                    <option value="Regular">
                                        Regular
                                    </option>

                                    <option value="Malo">
                                        Malo
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- Observaciones --}}
                        <div>

                            <label
                                for="observaciones"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Observaciones adicionales
                            </label>

                            <textarea
                                id="observaciones"
                                name="observaciones"
                                rows="3"
                                placeholder="Cualquier información adicional sobre el equipo..."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >{{ old('observaciones') }}</textarea>

                        </div>

                    </div>

                </section>


                {{-- =====================================================
                    MODAL INFORMATIVO EVIDENCIA
                ====================================================== --}}
                <div
                    x-show="showEvidenceInfo"
                    x-cloak
                    x-transition.opacity
                    class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm"
                    @keydown.escape.window="showEvidenceInfo = false"
                >

                    <div
                        @click.outside="showEvidenceInfo = false"
                        class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-700 dark:bg-slate-900"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400">

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
                                            d="M4 4h6v6H4V4zM14 4h6v6h-6V4zM4 14h6v6H4v-6zM14 14h2v2h-2v-2zM18 14h2v2h-2v-2zM14 18h2v2h-2v-2zM18 18h2v2h-2v-2z"
                                        />
                                    </svg>

                                </div>

                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                                    Evidencia del equipo
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                                    El QR para subir fotografías y evidencias se generará una vez registrada la orden.
                                </p>

                            </div>


                            <button
                                type="button"
                                @click="showEvidenceInfo = false"
                                class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-800 dark:hover:text-white"
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
                                        d="M6 6l12 12M18 6L6 18"
                                    />
                                </svg>

                            </button>

                        </div>


                        <div class="mt-5 rounded-xl bg-slate-50 p-4 dark:bg-slate-950">

                            <p class="text-xs leading-5 text-slate-500 dark:text-slate-400">
                                El flujo final permitirá escanear el QR desde otro dispositivo, tomar una fotografía o seleccionar un archivo y agregar una descripción. Cada evidencia quedará relacionada con esta orden.
                            </p>

                        </div>


                        <button
                            type="button"
                            @click="showEvidenceInfo = false"
                            class="mt-5 w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400"
                        >
                            Entendido
                        </button>

                    </div>

                </div>


                {{-- =====================================================
                    05. SERVICIO
                ====================================================== --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400">

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
                                        d="M14.7 6.3l3 3M5 19l4.5-1 9.8-9.8a2.1 2.1 0 00-3-3L6.5 15 5 19zM13 8l3 3"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900 dark:text-white">
                                    Detalles del servicio
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Define el trabajo que se realizará y los tiempos de entrega.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-5 sm:p-6">


                        {{-- Problema --}}
                        <div>

                            <label
                                for="problema_reportado"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Problema reportado
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea
                                id="problema_reportado"
                                name="problema_reportado"
                                rows="4"
                                required
                                placeholder="Describe el problema que reporta el cliente..."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >{{ old('problema_reportado') }}</textarea>

                        </div>


                        {{-- Solución --}}
                        <div>

                            <label
                                for="solucion"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Solución
                            </label>

                            <textarea
                                id="solucion"
                                name="solucion"
                                rows="4"
                                placeholder="Se completará conforme avance o finalice la reparación..."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >{{ old('solucion') }}</textarea>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                            {{-- Revisado anteriormente --}}
                            <div>

                                <label
                                    for="revisado_anteriormente"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    ¿Fue revisado anteriormente?
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="revisado_anteriormente"
                                    name="revisado_anteriormente"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >

                                    <option value="0">
                                        No
                                    </option>

                                    <option value="1">
                                        Sí
                                    </option>

                                </select>

                            </div>


                            {{-- Técnico --}}
                            <div>

                                <label
                                    for="tecnico_id"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Asignar técnico
                                </label>

                                <select
                                    id="tecnico_id"
                                    disabled
                                    class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-400 outline-none dark:border-slate-800 dark:bg-slate-950 dark:text-slate-600"
                                >

                                    <option>
                                        Módulo de técnicos pendiente
                                    </option>

                                </select>

                                <p class="mt-2 text-xs text-slate-400">
                                    La asignación se habilitará cuando se integre el módulo de técnicos.
                                </p>

                            </div>


                            {{-- Fecha reparación --}}
                            <div>

                                <label
                                    for="fecha_reparacion_programada"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Fecha de reparación programada
                                </label>

                                <input
                                    id="fecha_reparacion_programada"
                                    name="fecha_reparacion_programada"
                                    type="date"
                                    value="{{ old('fecha_reparacion_programada') }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            {{-- Fecha entrega --}}
                            <div>

                                <label
                                    for="fecha_entrega_prometida"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Fecha de entrega prometida
                                </label>

                                <input
                                    id="fecha_entrega_prometida"
                                    name="fecha_entrega_prometida"
                                    type="date"
                                    value="{{ old('fecha_entrega_prometida') }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            {{-- Hora entrega --}}
                            <div>

                                <label
                                    for="hora_entrega_prometida"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Hora de entrega prometida
                                </label>

                                <input
                                    id="hora_entrega_prometida"
                                    name="hora_entrega_prometida"
                                    type="time"
                                    value="{{ old('hora_entrega_prometida') }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                />

                            </div>


                            {{-- Sucursal --}}
                            <div>

                                <label
                                    for="branch_id"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Locación / sucursal
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="branch_id"
                                    name="branch_id"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >

                                    <option value="">
                                        Selecciona una sucursal
                                    </option>

                                    @foreach ($branches as $branch)

                                        <option
                                            value="{{ $branch->id }}"
                                            @selected(old('branch_id') == $branch->id)
                                        >
                                            {{ $branch->nombre }}
                                            —
                                            {{ $branch->municipio }}, {{ $branch->estado }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =====================================================
                    06. FIRMA
                ====================================================== --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300">

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
                                        d="M4 20c3.5-1 5.5-3 7.5-5M14 5l5 5M6 17l-2 3 3-2L19 6a2.1 2.1 0 00-3-3L6 15v2z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900 dark:text-white">
                                    Firma del cliente
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    La aceptación del servicio quedará asociada a la orden.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="flex flex-wrap gap-3">

                            {{-- Firmar pantalla --}}
                            <button
                                type="button"
                                @click="openSignature()"
                                class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400"
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
                                        d="M4 20c3.5-1 5.5-3 7.5-5M14 5l5 5M6 17l-2 3 3-2L19 6a2.1 2.1 0 00-3-3L6 15v2z"
                                    />
                                </svg>

                                Firmar en pantalla

                            </button>


                            {{-- Firma QR --}}
                            <button
                                type="button"
                                @click="showSignatureQR = true"
                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:border-cyan-300 hover:text-cyan-600 dark:border-slate-700 dark:text-slate-300 dark:hover:border-cyan-700 dark:hover:text-cyan-400"
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
                                        d="M4 4h6v6H4V4zM14 4h6v6h-6V4zM4 14h6v6H4v-6zM14 14h2v2h-2v-2zM18 14h2v2h-2v-2zM14 18h2v2h-2v-2zM18 18h2v2h-2v-2z"
                                    />
                                </svg>

                                Firmar mediante QR

                            </button>

                        </div>


                        {{-- Firma almacenada --}}
                        <div
                            x-show="signatureData"
                            x-transition
                            class="mt-5 max-w-md rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/20"
                        >

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">

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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-300">
                                        Firma registrada
                                    </p>

                                    <p class="text-xs text-emerald-600 dark:text-emerald-400">
                                        La firma se enviará junto con la orden.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <input
                            type="hidden"
                            name="firma"
                            id="firma"
                            x-model="signatureData"
                        />

                    </div>

                </section>


                {{-- =====================================================
                    MODAL FIRMA
                ====================================================== --}}
                <div
                    x-show="showSignature"
                    x-cloak
                    x-transition.opacity
                    class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-950/80 p-4 backdrop-blur-sm"
                >

                    <div
                        class="w-full max-w-2xl rounded-2xl border border-slate-700 bg-white p-5 shadow-2xl dark:bg-slate-900 sm:p-6"
                    >

                        <div class="mb-5 flex items-center justify-between gap-4">

                            <div>

                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                                    Firma del cliente
                                </h3>

                                <p class="mt-1 text-xs text-slate-400">
                                    Firma dentro del área indicada.
                                </p>

                            </div>

                            <button
                                type="button"
                                @click="closeSignature()"
                                class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
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
                                        d="M6 6l12 12M18 6L6 18"
                                    />
                                </svg>

                            </button>

                        </div>


                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-950">

                            <canvas
                                id="signature-canvas"
                                class="h-64 w-full touch-none"
                            ></canvas>

                        </div>


                        <div class="mt-4 flex justify-end gap-3">

                            <button
                                type="button"
                                @click="clearSignature()"
                                class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-500 transition hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800"
                            >
                                Limpiar
                            </button>

                            <button
                                type="button"
                                @click="saveSignature()"
                                class="rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400"
                            >
                                Guardar firma
                            </button>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    MODAL FIRMA QR
                ====================================================== --}}
                <div
                    x-show="showSignatureQR"
                    x-cloak
                    x-transition.opacity
                    class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-950/70 p-4 backdrop-blur-sm"
                >

                    <div
                        @click.outside="showSignatureQR = false"
                        class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-2xl dark:border-slate-700 dark:bg-slate-900"
                    >

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 4h6v6H4V4zM14 4h6v6h-6V4zM4 14h6v6H4v-6zM14 14h2v2h-2v-2zM18 14h2v2h-2v-2zM14 18h2v2h-2v-2zM18 18h2v2h-2v-2z"
                                />
                            </svg>

                        </div>


                        <h3 class="mt-4 text-lg font-bold text-slate-900 dark:text-white">
                            Firma mediante QR
                        </h3>


                        <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">
                            Una vez registrada la orden se generará un QR temporal para que el cliente pueda firmar desde otro dispositivo.
                        </p>


                        <div class="mt-5 rounded-xl bg-slate-50 p-5 dark:bg-slate-950">

                            <div class="mx-auto flex h-40 w-40 items-center justify-center rounded-xl border-2 border-dashed border-slate-300 text-slate-400 dark:border-slate-700">

                                <svg
                                    class="h-10 w-10"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 4h6v6H4V4zM14 4h6v6h-6V4zM4 14h6v6H4v-6zM14 14h2v2h-2v-2zM18 14h2v2h-2v-2zM14 18h2v2h-2v-2zM18 18h2v2h-2v-2z"
                                    />
                                </svg>

                            </div>

                            <p class="mt-3 text-xs text-slate-400">
                                QR disponible después de registrar la orden.
                            </p>

                        </div>


                        <div class="mt-4 flex items-center justify-center gap-2 text-xs text-amber-600 dark:text-amber-400">

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
                                    d="M12 8v4l2.5 2.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                            El QR será temporal y tendrá una fecha de expiración.

                        </div>


                        <button
                            type="button"
                            @click="showSignatureQR = false"
                            class="mt-6 w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400"
                        >
                            Cerrar

                        </button>

                    </div>

                </div>


                {{-- =====================================================
                    07. GARANTÍA Y COSTOS
                ====================================================== --}}
                <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/50 dark:text-cyan-400">

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
                                        d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9 12l2 2 4-4"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900 dark:text-white">
                                    Garantía y costos
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Define las condiciones económicas de la reparación.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


                            {{-- Garantía --}}
                            <div>

                                <label
                                    for="tiene_garantia"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    ¿Tiene garantía?
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="tiene_garantia"
                                    name="tiene_garantia"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >

                                    <option value="0">
                                        No
                                    </option>

                                    <option value="1">
                                        Sí
                                    </option>

                                </select>

                            </div>


                            {{-- Costo total --}}
                            <div>

                                <label
                                    for="costo_total"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Costo total
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-400">
                                        $
                                    </span>

                                    <input
                                        id="costo_total"
                                        name="costo_total"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('costo_total', '0.00') }}"
                                        x-model.number="costoTotal"
                                        @input="calculateBalance()"
                                        required
                                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-9 pr-4 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    />

                                </div>

                            </div>


                            {{-- Anticipo --}}
                            <div>

                                <label
                                    for="anticipo"
                                    class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                                >
                                    Anticipo
                                </label>

                                <div class="relative">

                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-400">
                                        $
                                    </span>

                                    <input
                                        id="anticipo"
                                        name="anticipo"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('anticipo', '0.00') }}"
                                        x-model.number="anticipo"
                                        @input="calculateBalance()"
                                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-9 pr-4 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    />

                                </div>

                            </div>

                        </div>


                        {{-- Saldo --}}
                        <div class="mt-6 flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between dark:border-slate-800">

                            <div>

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Saldo pendiente
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Se calcula automáticamente con base en el total y el anticipo.
                                </p>

                            </div>


                            <p
                                class="text-2xl font-bold text-slate-900 dark:text-white"
                                x-text="'$' + balance.toFixed(2)"
                            >
                                $0.00
                            </p>

                        </div>

                    </div>

                </section>


                {{-- =====================================================
                    ACCIONES FINALES
                ====================================================== --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:items-center sm:justify-between dark:border-slate-800">

                    <a
                        href="{{ route('service-orders.index') }}"
                        class="inline-flex items-center justify-center rounded-xl px-5 py-3 text-sm font-semibold text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-900 dark:hover:text-slate-200"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="group inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition-all duration-200 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-cyan-500 dark:text-slate-950 dark:hover:bg-cyan-400"
                    >

                        <svg
                            class="h-5 w-5 transition-transform duration-200 group-hover:scale-105"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M5 12l4 4L19 6"
                            />
                        </svg>

                        Confirmar y registrar

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =============================================================
        ALPINE / JAVASCRIPT
    ============================================================== --}}
    <script>

        function serviceOrderForm() {

            return {

                customerId: '{{ old('customer_id', '') }}',

                customer: {
                    nombre: '',
                    apellido_paterno: '',
                    apellido_materno: '',
                    telefono: '',
                    correo: '',
                    pais: '',
                    whatsapp: '',
                    contacto_alternativo: ''
                },


                lockType: '{{ old('tipo_bloqueo', '') }}',

                patternSize: '{{ old('tamano_patron', '3x3') }}',

                patternData: '',

                patternPoints: [],

                isDrawingPattern: false,

                patternCanvas: null,

                patternContext: null,


                signatureData: '',

                signatureCanvas: null,

                signatureContext: null,

                isDrawingSignature: false,

                showSignature: false,

                showSignatureQR: false,

                showEvidenceInfo: false,


                costoTotal: Number('{{ old('costo_total', '0') }}'),

                anticipo: Number('{{ old('anticipo', '0') }}'),

                balance: 0,


                /*
                |--------------------------------------------------------------------------
                | CLIENTE
                |--------------------------------------------------------------------------
                */

                loadCustomer() {

                    const select = document.getElementById('customer_id');

                    const option = select?.options[select.selectedIndex];

                    if (!option || !option.value) {

                        this.customer = {
                            nombre: '',
                            apellido_paterno: '',
                            apellido_materno: '',
                            telefono: '',
                            correo: '',
                            pais: '',
                            whatsapp: '',
                            contacto_alternativo: ''
                        };

                        return;

                    }


                    this.customer = {

                        nombre: option.dataset.nombre || '',

                        apellido_paterno: option.dataset.apellidoPaterno || '',

                        apellido_materno: option.dataset.apellidoMaterno || '',

                        telefono: option.dataset.telefono || '',

                        correo: option.dataset.correo || '',

                        pais: option.dataset.pais || '',

                        whatsapp: option.dataset.whatsapp || '',

                        contacto_alternativo:
                            option.dataset.contactoAlternativo || ''

                    };

                },


                /*
                |--------------------------------------------------------------------------
                | BLOQUEO
                |--------------------------------------------------------------------------
                */

                changeLockType() {

                    if (this.lockType !== 'Patrón') {

                        this.patternPoints = [];

                        this.patternData = '';

                        return;

                    }


                    this.$nextTick(() => {

                        this.initializePattern();

                    });

                },


                initializePattern() {

                    if (this.lockType !== 'Patrón') {
                        return;
                    }


                    const canvas = document.getElementById('pattern-canvas');

                    if (!canvas) {
                        return;
                    }


                    this.patternCanvas = canvas;

                    this.patternContext = canvas.getContext('2d');

                    this.patternPoints = [];

                    this.patternData = '';


                    this.drawPatternGrid();


                    canvas.onpointerdown = (event) => {

                        event.preventDefault();

                        this.isDrawingPattern = true;

                        this.addPatternPoint(event);

                    };


                    canvas.onpointermove = (event) => {

                        if (!this.isDrawingPattern) {
                            return;
                        }

                        event.preventDefault();

                        this.addPatternPoint(event);

                    };


                    canvas.onpointerup = () => {

                        this.isDrawingPattern = false;

                    };


                    canvas.onpointercancel = () => {

                        this.isDrawingPattern = false;

                    };

                },


                drawPatternGrid() {

                    if (!this.patternContext || !this.patternCanvas) {
                        return;
                    }


                    const ctx = this.patternContext;

                    const canvas = this.patternCanvas;

                    const size = this.patternSize === '4x4' ? 4 : 3;

                    ctx.clearRect(
                        0,
                        0,
                        canvas.width,
                        canvas.height
                    );


                    const padding = 45;

                    const usable =
                        canvas.width - (padding * 2);

                    const spacing =
                        usable / (size - 1);


                    ctx.strokeStyle =
                        '#06b6d4';

                    ctx.lineWidth = 2;


                    for (let row = 0; row < size; row++) {

                        for (let col = 0; col < size; col++) {

                            const x =
                                padding + (col * spacing);

                            const y =
                                padding + (row * spacing);


                            ctx.beginPath();

                            ctx.arc(
                                x,
                                y,
                                8,
                                0,
                                Math.PI * 2
                            );

                            ctx.fillStyle =
                                '#e2e8f0';

                            ctx.fill();

                            ctx.stroke();

                        }

                    }

                },


                addPatternPoint(event) {

                    if (!this.patternCanvas) {
                        return;
                    }


                    const rect =
                        this.patternCanvas.getBoundingClientRect();


                    const scaleX =
                        this.patternCanvas.width / rect.width;

                    const scaleY =
                        this.patternCanvas.height / rect.height;


                    const x =
                        (event.clientX - rect.left) * scaleX;

                    const y =
                        (event.clientY - rect.top) * scaleY;


                    const size =
                        this.patternSize === '4x4' ? 4 : 3;


                    const padding = 45;

                    const usable =
                        this.patternCanvas.width - (padding * 2);

                    const spacing =
                        usable / (size - 1);


                    let closest = null;

                    let minDistance = Infinity;


                    for (let row = 0; row < size; row++) {

                        for (let col = 0; col < size; col++) {

                            const pointX =
                                padding + (col * spacing);

                            const pointY =
                                padding + (row * spacing);


                            const distance =
                                Math.sqrt(
                                    Math.pow(x - pointX, 2) +
                                    Math.pow(y - pointY, 2)
                                );


                            if (distance < minDistance) {

                                minDistance = distance;

                                closest = {
                                    row,
                                    col,
                                    x: pointX,
                                    y: pointY
                                };

                            }

                        }

                    }


                    if (!closest || minDistance > 35) {
                        return;
                    }


                    const pointId =
                        `${closest.row}-${closest.col}`;


                    const alreadyExists =
                        this.patternPoints.some(
                            point => point.id === pointId
                        );


                    if (alreadyExists) {
                        return;
                    }


                    this.patternPoints.push({
                        id: pointId,
                        row: closest.row,
                        col: closest.col
                    });


                    this.patternData =
                        JSON.stringify({
                            size: this.patternSize,
                            points: this.patternPoints
                        });


                    this.drawPatternGrid();

                    this.drawPatternLine();

                },


                drawPatternLine() {

                    if (!this.patternContext || !this.patternCanvas) {
                        return;
                    }


                    const ctx = this.patternContext;

                    const size =
                        this.patternSize === '4x4' ? 4 : 3;

                    const padding = 45;

                    const usable =
                        this.patternCanvas.width - (padding * 2);

                    const spacing =
                        usable / (size - 1);


                    if (this.patternPoints.length === 0) {
                        return;
                    }


                    ctx.strokeStyle = '#0891b2';

                    ctx.lineWidth = 4;

                    ctx.lineCap = 'round';

                    ctx.lineJoin = 'round';


                    ctx.beginPath();


                    this.patternPoints.forEach((point, index) => {

                        const x =
                            padding + (point.col * spacing);

                        const y =
                            padding + (point.row * spacing);


                        if (index === 0) {

                            ctx.moveTo(x, y);

                        } else {

                            ctx.lineTo(x, y);

                        }

                    });


                    ctx.stroke();


                    this.patternPoints.forEach((point, index) => {

                        const x =
                            padding + (point.col * spacing);

                        const y =
                            padding + (point.row * spacing);


                        ctx.beginPath();

                        ctx.arc(
                            x,
                            y,
                            10,
                            0,
                            Math.PI * 2
                        );

                        ctx.fillStyle = '#0891b2';

                        ctx.fill();


                        ctx.fillStyle = '#ffffff';

                        ctx.font = 'bold 10px sans-serif';

                        ctx.textAlign = 'center';

                        ctx.textBaseline = 'middle';

                        ctx.fillText(
                            index + 1,
                            x,
                            y
                        );

                    });

                },


                clearPattern() {

                    this.patternPoints = [];

                    this.patternData = '';

                    this.drawPatternGrid();

                },


                /*
                |--------------------------------------------------------------------------
                | FIRMA
                |--------------------------------------------------------------------------
                */

                openSignature() {

                    this.showSignature = true;


                    this.$nextTick(() => {

                        this.initializeSignature();

                    });

                },


                initializeSignature() {

                    const canvas =
                        document.getElementById('signature-canvas');

                    if (!canvas) {
                        return;
                    }


                    this.signatureCanvas = canvas;


                    const rect =
                        canvas.getBoundingClientRect();


                    canvas.width =
                        rect.width * window.devicePixelRatio;

                    canvas.height =
                        rect.height * window.devicePixelRatio;


                    this.signatureContext =
                        canvas.getContext('2d');


                    this.signatureContext.scale(
                        window.devicePixelRatio,
                        window.devicePixelRatio
                    );


                    this.signatureContext.strokeStyle =
                        '#0f172a';

                    this.signatureContext.lineWidth = 2;

                    this.signatureContext.lineCap =
                        'round';

                    this.signatureContext.lineJoin =
                        'round';


                    canvas.onpointerdown = (event) => {

                        event.preventDefault();

                        this.isDrawingSignature = true;

                        this.signatureContext.beginPath();

                        const point =
                            this.getSignaturePoint(event);

                        this.signatureContext.moveTo(
                            point.x,
                            point.y
                        );

                    };


                    canvas.onpointermove = (event) => {

                        if (!this.isDrawingSignature) {
                            return;
                        }

                        event.preventDefault();


                        const point =
                            this.getSignaturePoint(event);


                        this.signatureContext.lineTo(
                            point.x,
                            point.y
                        );


                        this.signatureContext.stroke();

                    };


                    canvas.onpointerup = () => {

                        this.isDrawingSignature = false;

                    };


                    canvas.onpointercancel = () => {

                        this.isDrawingSignature = false;

                    };

                },


                getSignaturePoint(event) {

                    const rect =
                        this.signatureCanvas.getBoundingClientRect();


                    return {

                        x:
                            event.clientX - rect.left,

                        y:
                            event.clientY - rect.top

                    };

                },


                clearSignature() {

                    if (!this.signatureCanvas || !this.signatureContext) {
                        return;
                    }


                    const canvas =
                        this.signatureCanvas;


                    this.signatureContext.clearRect(
                        0,
                        0,
                        canvas.width,
                        canvas.height
                    );

                },


                saveSignature() {

                    if (!this.signatureCanvas) {
                        return;
                    }


                    this.signatureData =
                        this.signatureCanvas.toDataURL(
                            'image/png'
                        );


                    this.showSignature = false;

                },


                closeSignature() {

                    this.showSignature = false;

                },


                /*
                |--------------------------------------------------------------------------
                | COSTOS
                |--------------------------------------------------------------------------
                */

                calculateBalance() {

                    const total =
                        Number(this.costoTotal) || 0;

                    const advance =
                        Number(this.anticipo) || 0;


                    this.balance =
                        Math.max(
                            0,
                            total - advance
                        );

                },


                /*
                |--------------------------------------------------------------------------
                | INICIALIZACIÓN
                |--------------------------------------------------------------------------
                */

                init() {

                    this.loadCustomer();

                    this.calculateBalance();


                    if (this.lockType === 'Patrón') {

                        this.$nextTick(() => {

                            this.initializePattern();

                        });

                    }

                }

            };

        }

    </script>

</x-app-layout>