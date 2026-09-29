<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-slate-800 dark:text-slate-100">
                    {{ __('Agregar crédito') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Registra una nueva solicitud de crédito para un cliente.
                </p>
            </div>

            <a
                href="{{ url()->previous() }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mr-2 h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Regresar
            </a>
        </div>
    </x-slot>

    <div class="credit-form min-h-screen bg-slate-50 py-8 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-950/40">
                    <div class="flex items-center gap-2 font-semibold text-red-700 dark:text-red-300">
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
                                d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.71 2.14h17.64a2 2 0 001.71-2.14l-8.82-15a2 2 0 00-3.42 0z"
                            />
                        </svg>

                        Revisa los siguientes errores:
                    </div>

                    <ul class="mt-2 list-inside list-disc text-sm text-red-600 dark:text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('credit-applications.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
                x-data="creditApplicationForm()"
            >
                @csrf

                {{-- ==========================================================
                    SECCIÓN 1: DATOS GENERALES DEL CLIENTE
                =========================================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="border-b border-slate-200 bg-slate-100 px-6 py-5 dark:border-slate-700 dark:bg-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300">
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
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                                    Datos generales del cliente
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Selecciona el cliente que solicitará el crédito.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 p-6">

                        <div>
                            <label
                                for="cliente_id"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Cliente <span class="text-red-500">*</span>
                            </label>

                            <select
    id="customer_id"
    name="customer_id"
    required
    @change="loadCustomer($event)"
    class="form-select"
>
                                <option value="">Selecciona un cliente</option>

                                @foreach ($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        data-nombre="{{ $customer->nombre }}"
                                        data-apellido-paterno="{{ $customer->apellido_paterno ?? '' }}"
                                        data-apellido-materno="{{ $customer->apellido_materno ?? '' }}"
                                        data-empresa="{{ $customer->empresa ?? '' }}"
                                        data-telefono="{{ $customer->telefono ?? '' }}"
                                        data-whatsapp="{{ $customer->whatsapp ?? '' }}"
                                        data-correo="{{ $customer->correo ?? '' }}"
                                        data-pais="{{ $customer->pais ?? '' }}"
                                        data-codigo-postal="{{ $customer->codigo_postal ?? '' }}"
                                        data-estado="{{ $customer->estado ?? '' }}"
                                        data-municipio="{{ $customer->municipio ?? '' }}"
                                        data-colonia="{{ $customer->colonia ?? '' }}"
                                        data-calle="{{ $customer->calle ?? '' }}"
                                    >
                                        {{ $customer->nombre }}
                                        {{ $customer->apellido_paterno ?? '' }}
                                        {{ $customer->apellido_materno ?? '' }}

                                        @if (!empty($customer->empresa))
                                            — {{ $customer->empresa }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            @error('customer_id')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Información automática del cliente --}}
                        <div
                            x-show="customerSelected"
                            x-transition
                            class="customer-info rounded-2xl border p-5"
                        >
                            <div class="mb-4 flex items-center gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-cyan-600 dark:text-cyan-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"
                                    />
                                </svg>

                                <h4 class="font-semibold text-slate-800 dark:text-slate-100">
                                    Información del cliente
                                </h4>
                            </div>

                            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">

                                <div>
                                    <label class="form-label">
                                        Nombre
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.nombre"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Apellido paterno
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.apellidoPaterno"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Apellido materno
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.apellidoMaterno"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Empresa
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.empresa"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Teléfono
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.telefono"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        WhatsApp
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.whatsapp"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Correo electrónico
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.correo"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        País
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.pais"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Código postal
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.codigoPostal"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Estado
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.estado"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Municipio
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.municipio"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div>
                                    <label class="form-label">
                                        Colonia
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.colonia"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>

                                <div class="md:col-span-2 lg:col-span-3">
                                    <label class="form-label">
                                        Calle
                                    </label>

                                    <input
                                        type="text"
                                        x-model="customer.calle"
                                        readonly
                                        class="form-readonly"
                                    >
                                </div>
                            </div>
                        </div>

                        <div
                            x-show="!customerSelected"
                            class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-5 py-6 text-center dark:border-slate-600 dark:bg-slate-800/50"
                        >
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Selecciona un cliente para mostrar sus datos.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- ==========================================================
                    SECCIÓN 2: DOCUMENTOS REQUERIDOS
                =========================================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="border-b border-slate-200 bg-slate-100 px-6 py-5 dark:border-slate-700 dark:bg-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300">
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
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                                    Documentos requeridos
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Adjunta la documentación necesaria para la solicitud.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">

                        <div>
                            <label
                                for="identificacion_oficial"
                                class="form-label"
                            >
                                Identificación oficial <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="identificacion_oficial"
                                type="file"
                                name="identificacion_oficial"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="form-file"
                            >

                            <p class="form-help">
                                JPG, PNG o PDF.
                            </p>

                            @error('identificacion_oficial')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="comprobante_domicilio"
                                class="form-label"
                            >
                                Comprobante de domicilio <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="comprobante_domicilio"
                                type="file"
                                name="comprobante_domicilio"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="form-file"
                            >

                            <p class="form-help">
                                JPG, PNG o PDF.
                            </p>

                            @error('comprobante_domicilio')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="constancia_situacion_fiscal"
                                class="form-label"
                            >
                                Constancia de situación fiscal
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="constancia_situacion_fiscal"
                                type="file"
                                name="constancia_situacion_fiscal"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="form-file"
                            >

                            <p class="form-help">
                                JPG, PNG o PDF.
                            </p>

                            @error('constancia_situacion_fiscal')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- ==========================================================
                    SECCIÓN 3: DATOS ADICIONALES
                =========================================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="border-b border-slate-200 bg-slate-100 px-6 py-5 dark:border-slate-700 dark:bg-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300">
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
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9h6m-6 4h6m-6-8h.01"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                                    Datos adicionales
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Completa la información adicional del solicitante.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        <div>
                            <label
                                for="tipo_cliente"
                                class="form-label"
                            >
                                Tipo de cliente <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="tipo_cliente"
                                name="tipo_cliente"
                                required
                                class="form-select"
                            >
                                <option value="">Selecciona una opción</option>
                                <option value="persona_fisica" @selected(old('tipo_cliente') === 'persona_fisica')>
                                    Persona física
                                </option>
                                <option value="persona_moral" @selected(old('tipo_cliente') === 'persona_moral')>
                                    Persona moral
                                </option>
                                <option value="empresa" @selected(old('tipo_cliente') === 'empresa')>
                                    Empresa
                                </option>
                            </select>

                            @error('tipo_cliente')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="ocupacion_actividad"
                                class="form-label"
                            >
                                Ocupación o actividad
                            </label>

                            <input
                                id="ocupacion_actividad"
                                type="text"
                                name="ocupacion_actividad"
                                value="{{ old('ocupacion_actividad') }}"
                                class="form-input"
                                placeholder="Ej. Comerciante, empleado..."
                            >

                            @error('ocupacion_actividad')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="telefono_trabajo"
                                class="form-label"
                            >
                                Teléfono de trabajo
                            </label>

                            <input
                                id="telefono_trabajo"
                                type="text"
                                name="telefono_trabajo"
                                value="{{ old('telefono_trabajo') }}"
                                class="form-input"
                                placeholder="Número telefónico"
                            >

                            @error('telefono_trabajo')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="referencia_personal"
                                class="form-label"
                            >
                                Referencia personal
                            </label>

                            <input
                                id="referencia_personal"
                                type="text"
                                name="referencia_personal"
                                value="{{ old('referencia_personal') }}"
                                class="form-input"
                                placeholder="Nombre de la referencia"
                            >

                            @error('referencia_personal')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="telefono_referencia"
                                class="form-label"
                            >
                                Teléfono de referencia
                            </label>

                            <input
                                id="telefono_referencia"
                                type="text"
                                name="telefono_referencia"
                                value="{{ old('telefono_referencia') }}"
                                class="form-input"
                                placeholder="Número de teléfono"
                            >

                            @error('telefono_referencia')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label
                                for="observaciones_adicionales"
                                class="form-label"
                            >
                                Observaciones adicionales
                            </label>

                            <textarea
                                id="observaciones_adicionales"
                                name="observaciones_adicionales"
                                rows="4"
                                class="form-textarea"
                                placeholder="Agrega cualquier información adicional..."
                            >{{ old('observaciones_adicionales') }}</textarea>

                            @error('observaciones_adicionales')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- ==========================================================
                    SECCIÓN 4: INFORMACIÓN DEL MONTO
                =========================================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="border-b border-slate-200 bg-slate-100 px-6 py-5 dark:border-slate-700 dark:bg-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-950 dark:text-cyan-300">
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
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                                    Información del crédito
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Indica el monto y las condiciones de pago solicitadas.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        <div>
                            <label
                                for="cantidad_solicitada"
                                class="form-label"
                            >
                                Cantidad solicitada <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="cantidad_solicitada"
                                type="number"
                                name="cantidad_solicitada"
                                value="{{ old('cantidad_solicitada') }}"
                                min="0"
                                step="0.01"
                                required
                                class="form-input"
                                placeholder="0.00"
                            >

                            @error('cantidad_solicitada')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="moneda"
                                class="form-label"
                            >
                                Moneda <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="moneda"
                                name="moneda"
                                required
                                class="form-select"
                            >
                                <option value="">Selecciona una moneda</option>

                                <option
                                    value="MXN"
                                    @selected(old('moneda', 'MXN') === 'MXN')
                                >
                                    Peso mexicano (MXN)
                                </option>

                                <option
                                    value="USD"
                                    @selected(old('moneda') === 'USD')
                                >
                                    Dólar estadounidense (USD)
                                </option>

                                <option
                                    value="EUR"
                                    @selected(old('moneda') === 'EUR')
                                >
                                    Euro (EUR)
                                </option>
                            </select>

                            @error('moneda')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="frecuencia_pago"
                                class="form-label"
                            >
                                Frecuencia de pago <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="frecuencia_pago"
                                name="frecuencia_pago"
                                required
                                class="form-select"
                            >
                                <option value="">Selecciona una frecuencia</option>

                                <option
                                    value="semanal"
                                    @selected(old('frecuencia_pago') === 'semanal')
                                >
                                    Semanal
                                </option>

                                <option
                                    value="quincenal"
                                    @selected(old('frecuencia_pago') === 'quincenal')
                                >
                                    Quincenal
                                </option>

                                <option
                                    value="mensual"
                                    @selected(old('frecuencia_pago') === 'mensual')
                                >
                                    Mensual
                                </option>
                            </select>

                            @error('frecuencia_pago')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label
                                for="observaciones_monto"
                                class="form-label"
                            >
                                Observaciones del monto
                            </label>

                            <textarea
                                id="observaciones_monto"
                                name="observaciones_monto"
                                rows="4"
                                class="form-textarea"
                                placeholder="Agrega observaciones relacionadas con el monto o los pagos..."
                            >{{ old('observaciones_monto') }}</textarea>

                            @error('observaciones_monto')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- ==========================================================
                    BOTONES
                =========================================================== --}}

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ url()->previous() }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="mr-2 h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        Guardar solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==============================================================
        JAVASCRIPT DEL FORMULARIO
    ============================================================== --}}

    <script>
        function creditApplicationForm() {
            return {
                customerSelected: false,

                customer: {
                    nombre: '',
                    apellidoPaterno: '',
                    apellidoMaterno: '',
                    empresa: '',
                    telefono: '',
                    whatsapp: '',
                    correo: '',
                    pais: '',
                    codigoPostal: '',
                    estado: '',
                    municipio: '',
                    colonia: '',
                    calle: ''
                },

                loadCustomer(event) {
                    const select = event.target;
                    const option = select.options[select.selectedIndex];

                    if (!option.value) {
                        this.clearCustomer();
                        return;
                    }

                    const data = option.dataset;

                    this.customer = {
                        nombre: data.nombre || '',
                        apellidoPaterno: data.apellidoPaterno || '',
                        apellidoMaterno: data.apellidoMaterno || '',
                        empresa: data.empresa || '',
                        telefono: data.telefono || '',
                        whatsapp: data.whatsapp || '',
                        correo: data.correo || '',
                        pais: data.pais || '',
                        codigoPostal: data.codigoPostal || '',
                        estado: data.estado || '',
                        municipio: data.municipio || '',
                        colonia: data.colonia || '',
                        calle: data.calle || ''
                    };

                    this.customerSelected = true;
                },

                clearCustomer() {
                    this.customerSelected = false;

                    this.customer = {
                        nombre: '',
                        apellidoPaterno: '',
                        apellidoMaterno: '',
                        empresa: '',
                        telefono: '',
                        whatsapp: '',
                        correo: '',
                        pais: '',
                        codigoPostal: '',
                        estado: '',
                        municipio: '',
                        colonia: '',
                        calle: ''
                    };
                }
            };
        }
    </script>

    {{-- ==============================================================
        ESTILOS DEL FORMULARIO
    ============================================================== --}}

    <style>
        /*
        |--------------------------------------------------------------------------
        | Configuración general de colores
        |--------------------------------------------------------------------------
        */

        .credit-form {
            color-scheme: light;
        }

        .dark .credit-form {
            color-scheme: dark;
        }

        /*
        |--------------------------------------------------------------------------
        | Labels
        |--------------------------------------------------------------------------
        */

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
        }

        .dark .form-label {
            color: #e2e8f0;
        }

        /*
        |--------------------------------------------------------------------------
        | Inputs
        |--------------------------------------------------------------------------
        */

        .form-input,
        .form-select,
        .form-textarea {
            display: block;
            width: 100%;
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #0f172a;
            box-shadow: 0 1px 2px 0 rgb(15 23 42 / 0.05);
            transition:
                border-color 150ms ease,
                background-color 150ms ease,
                box-shadow 150ms ease;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #94a3b8;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #06b6d4;
            outline: none;
            box-shadow: 0 0 0 2px rgb(6 182 212 / 0.2);
        }

        /*
        |--------------------------------------------------------------------------
        | Inputs en modo oscuro
        |--------------------------------------------------------------------------
        */

        .dark .form-input,
        .dark .form-select,
        .dark .form-textarea {
            border-color: #475569 !important;
            background-color: #0f172a !important;
            color: #f8fafc !important;
        }

        .dark .form-input::placeholder,
        .dark .form-textarea::placeholder {
            color: #64748b !important;
        }

        .dark .form-input:focus,
        .dark .form-select:focus,
        .dark .form-textarea:focus {
            border-color: #22d3ee !important;
            background-color: #0f172a !important;
            color: #f8fafc !important;
            box-shadow: 0 0 0 2px rgb(34 211 238 / 0.2);
        }

        /*
        |--------------------------------------------------------------------------
        | Opciones de los selectores
        |--------------------------------------------------------------------------
        */

        .form-select option {
            background-color: #ffffff;
            color: #0f172a;
        }

        .dark .form-select option {
            background-color: #0f172a;
            color: #f8fafc;
        }

        /*
        |--------------------------------------------------------------------------
        | Campos de solo lectura
        |--------------------------------------------------------------------------
        */

        .form-readonly {
            display: block;
            width: 100%;
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            background-color: #e2e8f0 !important;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #475569 !important;
            cursor: not-allowed;
        }

        .dark .form-readonly {
            border-color: #475569 !important;
            background-color: #1e293b !important;
            color: #cbd5e1 !important;
        }

        /*
        |--------------------------------------------------------------------------
        | Campos de archivos
        |--------------------------------------------------------------------------
        */

        .form-file {
            display: block;
            width: 100%;
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            padding: 0.5rem;
            font-size: 0.875rem;
            color: #334155;
        }

        .dark .form-file {
            border-color: #475569 !important;
            background-color: #0f172a !important;
            color: #e2e8f0 !important;
        }

        .form-file::file-selector-button {
            margin-right: 0.75rem;
            border: none;
            border-radius: 0.5rem;
            background-color: #0891b2;
            padding: 0.5rem 0.875rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 150ms ease;
        }

        .form-file::file-selector-button:hover {
            background-color: #0e7490;
        }

        /*
        |--------------------------------------------------------------------------
        | Texto de ayuda y errores
        |--------------------------------------------------------------------------
        */

        .form-help {
            margin-top: 0.375rem;
            font-size: 0.75rem;
            color: #64748b;
        }

        .dark .form-help {
            color: #94a3b8;
        }

        .form-error {
            margin-top: 0.375rem;
            font-size: 0.75rem;
            color: #dc2626;
        }

        .dark .form-error {
            color: #fca5a5;
        }

        /*
        |--------------------------------------------------------------------------
        | Información del cliente
        |--------------------------------------------------------------------------
        */

        .customer-info {
            border-color: #cbd5e1;
            background-color: #f1f5f9;
        }

        .dark .customer-info {
            border-color: #475569 !important;
            background-color: #1e293b !important;
        }

        /*
        |--------------------------------------------------------------------------
        | Ajustes para dispositivos pequeños
        |--------------------------------------------------------------------------
        */

        @media (max-width: 640px) {
            .form-input,
            .form-select,
            .form-textarea,
            .form-readonly {
                font-size: 16px;
            }
        }
    </style>
</x-app-layout>