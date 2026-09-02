<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8 dark:bg-slate-950">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-8">
                <a
                    href="{{ route('customers.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
                >
                    ← Volver a clientes
                </a>

                <div class="mt-5">
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                        Administración
                    </p>

                    <h1 class="mt-1 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        Editar cliente
                    </h1>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Actualiza la información de {{ $customer->nombre }} {{ $customer->apellido_paterno }}.
                    </p>
                </div>
            </div>

            {{-- Errores --}}
            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 dark:border-red-900/50 dark:bg-red-950/30">
                    <p class="text-sm font-bold text-red-700 dark:text-red-400">
                        Revisa los siguientes campos:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600 dark:text-red-400">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('customers.update', $customer) }}"
                method="POST"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                {{-- Información personal --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Información personal
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Datos generales del cliente.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                        {{-- Nombre --}}
                        <div>
                            <label for="nombre" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Nombre
                            </label>

                            <input
                                id="nombre"
                                name="nombre"
                                type="text"
                                value="{{ old('nombre', $customer->nombre) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Apellido paterno --}}
                        <div>
                            <label for="apellido_paterno" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Apellido paterno
                            </label>

                            <input
                                id="apellido_paterno"
                                name="apellido_paterno"
                                type="text"
                                value="{{ old('apellido_paterno', $customer->apellido_paterno) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Apellido materno --}}
                        <div>
                            <label for="apellido_materno" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Apellido materno
                            </label>

                            <input
                                id="apellido_materno"
                                name="apellido_materno"
                                type="text"
                                value="{{ old('apellido_materno', $customer->apellido_materno) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <label for="telefono" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Teléfono
                            </label>

                            <input
                                id="telefono"
                                name="telefono"
                                type="tel"
                                value="{{ old('telefono', $customer->telefono) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- País --}}
                        <div>
                            <label for="pais" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                País
                            </label>

                            <select
                                id="pais"
                                name="pais"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="">Selecciona un país</option>
                                <option value="México" @selected(old('pais', $customer->pais) === 'México')>México</option>
                                <option value="Estados Unidos" @selected(old('pais', $customer->pais) === 'Estados Unidos')>Estados Unidos</option>
                                <option value="Canadá" @selected(old('pais', $customer->pais) === 'Canadá')>Canadá</option>
                                <option value="Guatemala" @selected(old('pais', $customer->pais) === 'Guatemala')>Guatemala</option>
                                <option value="Belice" @selected(old('pais', $customer->pais) === 'Belice')>Belice</option>
                            </select>
                        </div>

                        {{-- WhatsApp --}}
                        <div>
                            <label for="whatsapp" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                WhatsApp
                            </label>

                            <input
                                id="whatsapp"
                                name="whatsapp"
                                type="tel"
                                value="{{ old('whatsapp', $customer->whatsapp) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Correo --}}
                        <div class="md:col-span-2">
                            <label for="correo" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Correo
                            </label>

                            <input
                                id="correo"
                                name="correo"
                                type="email"
                                value="{{ old('correo', $customer->correo) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Contacto alternativo --}}
                        <div>
                            <label for="contacto_alternativo" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Contacto alternativo
                                <span class="font-normal text-slate-400">(opcional)</span>
                            </label>

                            <input
                                id="contacto_alternativo"
                                name="contacto_alternativo"
                                type="text"
                                value="{{ old('contacto_alternativo', $customer->contacto_alternativo) }}"
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                    </div>
                </div>

                {{-- Domicilio --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Domicilio
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            El estado, municipio y colonias se obtienen automáticamente mediante el código postal.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- Código postal --}}
                        <div>
                            <label for="codigo_postal" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Código postal
                            </label>

                            <input
                                id="codigo_postal"
                                name="codigo_postal"
                                type="text"
                                inputmode="numeric"
                                maxlength="5"
                                value="{{ old('codigo_postal', $customer->codigo_postal) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >

                            <p
                                id="cp-loading"
                                class="mt-2 hidden text-xs font-medium text-slate-500 dark:text-slate-400"
                            >
                                Consultando código postal...
                            </p>

                            <p
                                id="cp-error"
                                class="mt-2 hidden text-xs font-medium text-red-500"
                            >
                                No se pudo consultar el código postal.
                            </p>
                        </div>

                        {{-- Estado --}}
                        <div>
                            <label for="estado" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Estado
                            </label>

                            <input
                                id="estado"
                                name="estado"
                                type="text"
                                value="{{ old('estado', $customer->estado) }}"
                                readonly
                                required
                                class="w-full rounded-xl border-slate-200 bg-slate-100 text-sm text-slate-600 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300"
                            >
                        </div>

                        {{-- Municipio --}}
                        <div>
                            <label for="municipio" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Municipio
                            </label>

                            <input
                                id="municipio"
                                name="municipio"
                                type="text"
                                value="{{ old('municipio', $customer->municipio) }}"
                                readonly
                                required
                                class="w-full rounded-xl border-slate-200 bg-slate-100 text-sm text-slate-600 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300"
                            >
                        </div>

                        {{-- Colonia --}}
                        <div>
                            <label for="colonia" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Colonia
                            </label>

                            <select
                                id="colonia"
                                name="colonia"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="{{ old('colonia', $customer->colonia) }}">
                                    {{ old('colonia', $customer->colonia) }}
                                </option>
                            </select>
                        </div>

                        {{-- Calle --}}
                        <div class="md:col-span-2">
                            <label for="calle" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Calle
                            </label>

                            <input
                                id="calle"
                                name="calle"
                                type="text"
                                value="{{ old('calle', $customer->calle) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Número exterior --}}
                        <div>
                            <label for="numero_exterior" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                No. exterior
                            </label>

                            <input
                                id="numero_exterior"
                                name="numero_exterior"
                                type="text"
                                value="{{ old('numero_exterior', $customer->numero_exterior) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Número interior --}}
                        <div>
                            <label for="numero_interior" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                No. interior
                                <span class="font-normal text-slate-400">(opcional)</span>
                            </label>

                            <input
                                id="numero_interior"
                                name="numero_interior"
                                type="text"
                                value="{{ old('numero_interior', $customer->numero_interior) }}"
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                    </div>
                </div>

                {{-- Información comercial --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Información comercial
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Datos fiscales y comerciales del cliente.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- Fecha de nacimiento --}}
                        <div>
                            <label for="fecha_nacimiento" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Fecha de nacimiento
                            </label>

                            <input
                                id="fecha_nacimiento"
                                name="fecha_nacimiento"
                                type="date"
                                value="{{ old('fecha_nacimiento', $customer->fecha_nacimiento?->format('Y-m-d')) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Precio --}}
                        <div>
                            <label for="precio" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Precio
                            </label>

                            <select
                                id="precio"
                                name="precio"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="">Selecciona un precio</option>

                                <option
                                    value="Precio público"
                                    @selected(old('precio', $customer->precio) === 'Precio público')
                                >
                                    Precio público
                                </option>

                                <option
                                    value="Precio mayoreo"
                                    @selected(old('precio', $customer->precio) === 'Precio mayoreo')
                                >
                                    Precio mayoreo
                                </option>

                                <option
                                    value="Precio técnico"
                                    @selected(old('precio', $customer->precio) === 'Precio técnico')
                                >
                                    Precio técnico
                                </option>
                            </select>
                        </div>

                        {{-- Tipo de identificación --}}
                        <div>
                            <label for="tipo_identificacion" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Tipo de identificación
                            </label>

                            <select
                                id="tipo_identificacion"
                                name="tipo_identificacion"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="">Selecciona una opción</option>

                                <option value="INE" @selected(old('tipo_identificacion', $customer->tipo_identificacion) === 'INE')>
                                    INE
                                </option>

                                <option value="Pasaporte" @selected(old('tipo_identificacion', $customer->tipo_identificacion) === 'Pasaporte')>
                                    Pasaporte
                                </option>

                                <option value="Licencia de conducir" @selected(old('tipo_identificacion', $customer->tipo_identificacion) === 'Licencia de conducir')>
                                    Licencia de conducir
                                </option>

                                <option value="CURP" @selected(old('tipo_identificacion', $customer->tipo_identificacion) === 'CURP')>
                                    CURP
                                </option>
                            </select>
                        </div>

                        {{-- Régimen fiscal --}}
                        <div>
                            <label for="regimen_fiscal" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Régimen fiscal
                            </label>

                            <select
                                id="regimen_fiscal"
                                name="regimen_fiscal"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="">Selecciona un régimen</option>

                                <option value="Régimen Simplificado de Confianza (RESICO)" @selected(old('regimen_fiscal', $customer->regimen_fiscal) === 'Régimen Simplificado de Confianza (RESICO)')>
                                    Régimen Simplificado de Confianza (RESICO)
                                </option>

                                <option value="Sueldos y salarios" @selected(old('regimen_fiscal', $customer->regimen_fiscal) === 'Sueldos y salarios')>
                                    Sueldos y salarios
                                </option>

                                <option value="Actividad empresarial" @selected(old('regimen_fiscal', $customer->regimen_fiscal) === 'Actividad empresarial')>
                                    Actividad empresarial
                                </option>

                                <option value="Régimen de Incorporación Fiscal (RIF)" @selected(old('regimen_fiscal', $customer->regimen_fiscal) === 'Régimen de Incorporación Fiscal (RIF)')>
                                    Régimen de Incorporación Fiscal (RIF)
                                </option>

                                <option value="Persona moral" @selected(old('regimen_fiscal', $customer->regimen_fiscal) === 'Persona moral')>
                                    Persona moral
                                </option>

                                <option value="Sin obligaciones fiscales" @selected(old('regimen_fiscal', $customer->regimen_fiscal) === 'Sin obligaciones fiscales')>
                                    Sin obligaciones fiscales
                                </option>
                            </select>
                        </div>

                        {{-- Razón social --}}
                        <div>
                            <label for="razon_social" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Razón social
                            </label>

                            <input
                                id="razon_social"
                                name="razon_social"
                                type="text"
                                value="{{ old('razon_social', $customer->razon_social) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Empresa --}}
                        <div>
                            <label for="empresa" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Empresa
                            </label>

                            <input
                                id="empresa"
                                name="empresa"
                                type="text"
                                value="{{ old('empresa', $customer->empresa) }}"
                                required
                                class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                    </div>
                </div>

                {{-- Botones --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('customers.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                    >
                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>
    </div>

    {{-- Código postal --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const codigoPostalInput = document.getElementById('codigo_postal');
            const estadoInput = document.getElementById('estado');
            const municipioInput = document.getElementById('municipio');
            const coloniaSelect = document.getElementById('colonia');

            const loading = document.getElementById('cp-loading');
            const errorMessage = document.getElementById('cp-error');

            if (!codigoPostalInput) {
                return;
            }

            const coloniaActual = @json(old('colonia', $customer->colonia));

            async function buscarCodigoPostal(codigoPostal, conservarColonia = false) {

                if (!/^\d{5}$/.test(codigoPostal)) {
                    return;
                }

                loading.classList.remove('hidden');
                errorMessage.classList.add('hidden');

                try {

                    const response = await fetch(
                        `/api/codigo-postal/${codigoPostal}`
                    );

                    if (!response.ok) {
                        throw new Error('Código postal no encontrado');
                    }

                    const responseData = await response.json();

                    if (!responseData.success || !responseData.data) {
                        throw new Error('Respuesta inválida');
                    }

                    const data = responseData.data;

                    estadoInput.value = data.estado ?? '';
                    municipioInput.value = data.municipio ?? '';

                    coloniaSelect.innerHTML = '';

                    if (
                        Array.isArray(data.asentamientos) &&
                        data.asentamientos.length > 0
                    ) {

                        const placeholder = document.createElement('option');

                        placeholder.value = '';
                        placeholder.textContent = 'Selecciona una colonia';
                        placeholder.disabled = true;

                        coloniaSelect.appendChild(placeholder);

                        data.asentamientos.forEach(asentamiento => {

                            const option = document.createElement('option');

                            option.value = asentamiento.nombre;
                            option.textContent = asentamiento.nombre;

                            if (
                                conservarColonia &&
                                asentamiento.nombre === coloniaActual
                            ) {
                                option.selected = true;
                            }

                            coloniaSelect.appendChild(option);
                        });

                        if (!conservarColonia) {
                            coloniaSelect.value = '';
                        }

                    } else {

                        const option = document.createElement('option');

                        option.value = '';
                        option.textContent = 'No se encontraron colonias';
                        option.disabled = true;
                        option.selected = true;

                        coloniaSelect.appendChild(option);
                    }

                } catch (error) {

                    console.error(
                        'Error al consultar código postal:',
                        error
                    );

                    errorMessage.classList.remove('hidden');

                } finally {

                    loading.classList.add('hidden');
                }
            }

            codigoPostalInput.addEventListener('input', () => {

                const codigoPostal = codigoPostalInput.value
                    .replace(/\D/g, '')
                    .slice(0, 5);

                codigoPostalInput.value = codigoPostal;

                if (codigoPostal.length === 5) {
                    buscarCodigoPostal(codigoPostal, false);
                }
            });

            const codigoPostalInicial = codigoPostalInput.value
                .replace(/\D/g, '')
                .slice(0, 5);

            if (codigoPostalInicial.length === 5) {
                buscarCodigoPostal(codigoPostalInicial, true);
            }

        });
    </script>
</x-app-layout>

