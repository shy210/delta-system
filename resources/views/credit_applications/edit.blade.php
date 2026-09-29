<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Editar línea de crédito
                </h2>

                <p class="text-sm text-slate-500">
                    Modifica la información de la solicitud.
                </p>
            </div>

            <a
                href="{{ route('credit-applications.show', $creditApplication) }}"
                class="rounded-xl bg-slate-200 px-4 py-2 text-center text-sm font-semibold text-slate-700 hover:bg-slate-300"
            >
                Cancelar
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">

            @if ($errors->any())
                <div class="mb-6 rounded-2xl bg-red-100 p-4 text-sm text-red-700">
                    <p class="mb-2 font-bold">
                        Revisa los siguientes errores:
                    </p>

                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('credit-applications.update', $creditApplication) }}"
                method="POST"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                {{-- Cliente y estado --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <h3 class="mb-5 text-lg font-bold text-slate-800">
                        Información principal
                    </h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label for="customer_id" class="mb-2 block text-sm font-semibold text-slate-700">
                                Cliente
                            </label>

                            <select
                                name="customer_id"
                                id="customer_id"
                                required
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                                <option value="">Selecciona un cliente</option>

                                @foreach ($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        @selected(old('customer_id', $creditApplication->customer_id) == $customer->id)
                                    >
                                        {{ $customer->nombre }}
                                        {{ $customer->apellido_paterno }}
                                        {{ $customer->apellido_materno }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="estado" class="mb-2 block text-sm font-semibold text-slate-700">
                                Estado
                            </label>

                            <select
                                name="estado"
                                id="estado"
                                required
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                                @foreach ([
                                    'pendiente' => 'Pendiente',
                                    'aprobada' => 'Aprobada',
                                    'rechazada' => 'Rechazada',
                                    'cancelada' => 'Cancelada',
                                ] as $value => $label)
                                    <option
                                        value="{{ $value }}"
                                        @selected(old('estado', $creditApplication->estado) === $value)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="tipo_cliente" class="mb-2 block text-sm font-semibold text-slate-700">
                                Tipo de cliente
                            </label>

                            <select
                                name="tipo_cliente"
                                id="tipo_cliente"
                                required
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                                <option value="persona_fisica" @selected(old('tipo_cliente', $creditApplication->tipo_cliente) === 'persona_fisica')>
                                    Persona física
                                </option>

                                <option value="persona_moral" @selected(old('tipo_cliente', $creditApplication->tipo_cliente) === 'persona_moral')>
                                    Persona moral
                                </option>

                                <option value="empresa" @selected(old('tipo_cliente', $creditApplication->tipo_cliente) === 'empresa')>
                                    Empresa
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="ocupacion_actividad" class="mb-2 block text-sm font-semibold text-slate-700">
                                Ocupación o actividad
                            </label>

                            <input
                                type="text"
                                name="ocupacion_actividad"
                                id="ocupacion_actividad"
                                value="{{ old('ocupacion_actividad', $creditApplication->ocupacion_actividad) }}"
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                        </div>
                    </div>
                </div>

                {{-- Datos de contacto --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <h3 class="mb-5 text-lg font-bold text-slate-800">
                        Datos de contacto y referencia
                    </h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label for="telefono_trabajo" class="mb-2 block text-sm font-semibold text-slate-700">
                                Teléfono de trabajo
                            </label>

                            <input
                                type="text"
                                name="telefono_trabajo"
                                id="telefono_trabajo"
                                value="{{ old('telefono_trabajo', $creditApplication->telefono_trabajo) }}"
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                        </div>

                        <div>
                            <label for="referencia_personal" class="mb-2 block text-sm font-semibold text-slate-700">
                                Referencia personal
                            </label>

                            <input
                                type="text"
                                name="referencia_personal"
                                id="referencia_personal"
                                value="{{ old('referencia_personal', $creditApplication->referencia_personal) }}"
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                        </div>

                        <div>
                            <label for="telefono_referencia" class="mb-2 block text-sm font-semibold text-slate-700">
                                Teléfono de referencia
                            </label>

                            <input
                                type="text"
                                name="telefono_referencia"
                                id="telefono_referencia"
                                value="{{ old('telefono_referencia', $creditApplication->telefono_referencia) }}"
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                        </div>
                    </div>
                </div>

                {{-- Datos del crédito --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <h3 class="mb-5 text-lg font-bold text-slate-800">
                        Datos del crédito
                    </h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                        <div>
                            <label for="cantidad_solicitada" class="mb-2 block text-sm font-semibold text-slate-700">
                                Cantidad solicitada
                            </label>

                            <input
                                type="number"
                                name="cantidad_solicitada"
                                id="cantidad_solicitada"
                                step="0.01"
                                min="0"
                                value="{{ old('cantidad_solicitada', $creditApplication->cantidad_solicitada) }}"
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                        </div>

                        <div>
                            <label for="moneda" class="mb-2 block text-sm font-semibold text-slate-700">
                                Moneda
                            </label>

                            <select
                                name="moneda"
                                id="moneda"
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                                @foreach (['MXN' => 'Peso mexicano', 'USD' => 'Dólar', 'EUR' => 'Euro'] as $value => $label)
                                    <option
                                        value="{{ $value }}"
                                        @selected(old('moneda', $creditApplication->moneda) === $value)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="frecuencia_pago" class="mb-2 block text-sm font-semibold text-slate-700">
                                Frecuencia de pago
                            </label>

                            <select
                                name="frecuencia_pago"
                                id="frecuencia_pago"
                                class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                            >
                                @foreach (['semanal' => 'Semanal', 'quincenal' => 'Quincenal', 'mensual' => 'Mensual'] as $value => $label)
                                    <option
                                        value="{{ $value }}"
                                        @selected(old('frecuencia_pago', $creditApplication->frecuencia_pago) === $value)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="observaciones_monto" class="mb-2 block text-sm font-semibold text-slate-700">
                            Observaciones del monto
                        </label>

                        <textarea
                            name="observaciones_monto"
                            id="observaciones_monto"
                            rows="3"
                            class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                        >{{ old('observaciones_monto', $creditApplication->observaciones_monto) }}</textarea>
                    </div>
                </div>

                {{-- Observaciones adicionales --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <label for="observaciones_adicionales" class="mb-2 block text-sm font-semibold text-slate-700">
                        Observaciones adicionales
                    </label>

                    <textarea
                        name="observaciones_adicionales"
                        id="observaciones_adicionales"
                        rows="4"
                        class="w-full rounded-xl border-slate-300 text-sm focus:border-cyan-500 focus:ring-cyan-500"
                    >{{ old('observaciones_adicionales', $creditApplication->observaciones_adicionales) }}</textarea>
                </div>

                {{-- Aviso --}}
                <div class="rounded-2xl border border-cyan-200 bg-cyan-50 p-4 text-sm text-cyan-800">
                    Los documentos adjuntos actuales se conservarán. Esta sección permite modificar los datos de la solicitud.
                </div>

                {{-- Botones --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a
                        href="{{ route('credit-applications.show', $creditApplication) }}"
                        class="rounded-xl bg-slate-200 px-6 py-3 text-center text-sm font-semibold text-slate-700 hover:bg-slate-300"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-cyan-600 px-6 py-3 text-sm font-semibold text-white hover:bg-cyan-700"
                    >
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>