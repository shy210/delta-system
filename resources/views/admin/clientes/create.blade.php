
<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-8 dark:bg-slate-950">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-8">

                <a
                    href="{{ route('customers.index') }}"
                    class="text-sm font-semibold text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
                >
                    ← Volver a clientes
                </a>

                <p class="mt-6 text-sm font-semibold text-slate-500 dark:text-slate-400">
                    Administración / Clientes
                </p>

                <h1 class="mt-1 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                    Agregar cliente
                </h1>

                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                    Registra la información del cliente para incorporarlo al sistema.
                </p>

            </div>

            {{-- Errores --}}
            @if($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-950/30">

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
                action="{{ route('customers.store') }}"
                method="POST"
                class="space-y-6"
            >

                @csrf

                {{-- Datos personales --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                    <div class="mb-6">

                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Datos personales
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Información básica del cliente.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                        {{-- Nombre --}}
                        <div>

                            <label
                                for="nombre"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Nombre
                            </label>

                            <input
                                id="nombre"
                                name="nombre"
                                type="text"
                                value="{{ old('nombre') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                        {{-- Apellido paterno --}}
                        <div>

                            <label
                                for="apellido_paterno"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Apellido paterno
                            </label>

                            <input
                                id="apellido_paterno"
                                name="apellido_paterno"
                                type="text"
                                value="{{ old('apellido_paterno') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                        {{-- Apellido materno --}}
                        <div>

                            <label
                                for="apellido_materno"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Apellido materno
                            </label>

                            <input
                                id="apellido_materno"
                                name="apellido_materno"
                                type="text"
                                value="{{ old('apellido_materno') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                        {{-- Teléfono --}}
                        <div>

                            <label
                                for="telefono"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Teléfono
                            </label>

                            <input
                                id="telefono"
                                name="telefono"
                                type="tel"
                                value="{{ old('telefono') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                        {{-- WhatsApp --}}
                        <div>

                            <label
                                for="whatsapp"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                WhatsApp
                            </label>

                            <input
                                id="whatsapp"
                                name="whatsapp"
                                type="tel"
                                value="{{ old('whatsapp') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                        {{-- Correo --}}
                        <div>

                            <label
                                for="correo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Correo
                            </label>

                            <input
                                id="correo"
                                name="correo"
                                type="email"
                                value="{{ old('correo') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                        {{-- Contacto alternativo --}}
                        <div class="md:col-span-2">

                            <label
                                for="contacto_alternativo"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Contacto alternativo
                                <span class="font-normal text-slate-400">(Opcional)</span>
                            </label>

                            <input
                                id="contacto_alternativo"
                                name="contacto_alternativo"
                                type="text"
                                value="{{ old('contacto_alternativo') }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                        {{-- Fecha de nacimiento --}}
                        <div>

                            <label
                                for="fecha_nacimiento"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Fecha de nacimiento
                            </label>

                            <input
                                id="fecha_nacimiento"
                                name="fecha_nacimiento"
                                type="date"
                                value="{{ old('fecha_nacimiento') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                    </div>

                </section>


                {{-- Domicilio --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                    <div class="mb-6">

                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Domicilio
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Ingresa el código postal para obtener automáticamente el estado, municipio y colonias.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                        {{-- País --}}
                        <div>

                            <label
                                for="pais"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                País
                            </label>

                            <select
                                id="pais"
                                name="pais"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                                <option value="">
                                    Selecciona un país
                                </option>

                                <option value="México" @selected(old('pais') === 'México')>
                                    México
                                </option>

                                <option value="Estados Unidos" @selected(old('pais') === 'Estados Unidos')>
                                    Estados Unidos
                                </option>

                                <option value="Canadá" @selected(old('pais') === 'Canadá')>
                                    Canadá
                                </option>

                                <option value="Guatemala" @selected(old('pais') === 'Guatemala')>
                                    Guatemala
                                </option>

                                <option value="Belice" @selected(old('pais') === 'Belice')>
                                    Belice
                                </option>

                            </select>

                        </div>


                        {{-- Código postal --}}
                        <div>

                            <label
                                for="codigo_postal"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Código postal
                            </label>

                            <input
                                id="codigo_postal"
                                name="codigo_postal"
                                type="text"
                                inputmode="numeric"
                                maxlength="5"
                                value="{{ old('codigo_postal') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                            <p
                                id="cp-loading"
                                class="mt-2 hidden text-xs font-medium text-slate-400"
                            >
                                Consultando código postal...
                            </p>

                            <p
                                id="cp-error"
                                class="mt-2 hidden text-xs font-medium text-red-500"
                            >
                                No se pudo encontrar el código postal.
                            </p>

                        </div>


                        {{-- Estado --}}
                        <div>

                            <label
                                for="estado"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Estado
                            </label>

                            <input
                                id="estado"
                                name="estado"
                                type="text"
                                value="{{ old('estado') }}"
                                readonly
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-slate-100 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>


                        {{-- Municipio --}}
                        <div>

                            <label
                                for="municipio"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Municipio
                            </label>

                            <input
                                id="municipio"
                                name="municipio"
                                type="text"
                                value="{{ old('municipio') }}"
                                readonly
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-slate-100 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>


                        {{-- Colonia --}}
                        <div>

                            <label
                                for="colonia"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Colonia
                            </label>

                            <select
                                id="colonia"
                                name="colonia"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                                <option value="">
                                    Primero ingresa el código postal
                                </option>

                            </select>

                        </div>


                        {{-- Calle --}}
                        <div>

                            <label
                                for="calle"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Calle
                            </label>

                            <input
                                id="calle"
                                name="calle"
                                type="text"
                                value="{{ old('calle') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>


                        {{-- Número exterior --}}
                        <div>

                            <label
                                for="numero_exterior"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                No. exterior
                            </label>

                            <input
                                id="numero_exterior"
                                name="numero_exterior"
                                type="text"
                                value="{{ old('numero_exterior') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>


                        {{-- Número interior --}}
                        <div>

                            <label
                                for="numero_interior"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                No. interior
                                <span class="font-normal text-slate-400">(Opcional)</span>
                            </label>

                            <input
                                id="numero_interior"
                                name="numero_interior"
                                type="text"
                                value="{{ old('numero_interior') }}"
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                    </div>

                </section>


                {{-- Información fiscal y comercial --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

                    <div class="mb-6">

                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Información fiscal y comercial
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Información necesaria para identificar y administrar al cliente.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- Precio --}}
                        <div>

                            <label
                                for="precio"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Precio
                            </label>

                            <select
                                id="precio"
                                name="precio"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                                <option value="">
                                    Selecciona un precio
                                </option>

                                <option
                                    value="Precio público"
                                    @selected(old('precio') === 'Precio público')
                                >
                                    Precio público
                                </option>

                                <option
                                    value="Precio mayoreo"
                                    @selected(old('precio') === 'Precio mayoreo')
                                >
                                    Precio mayoreo
                                </option>

                                <option
                                    value="Precio técnico"
                                    @selected(old('precio') === 'Precio técnico')
                                >
                                    Precio técnico
                                </option>

                            </select>

                        </div>


                        {{-- Tipo de identificación --}}
                        <div>

                            <label
                                for="tipo_identificacion"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Tipo de identificación
                            </label>

                           <select
    id="tipo_identificacion"
    name="tipo_identificacion"
    required
    class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
>
    <option value="">
        Selecciona un tipo
    </option>

    <option value="INE" @selected(old('tipo_identificacion') === 'INE')>
        INE
    </option>

    <option value="Pasaporte" @selected(old('tipo_identificacion') === 'Pasaporte')>
        Pasaporte
    </option>

    <option value="Licencia de conducir" @selected(old('tipo_identificacion') === 'Licencia de conducir')>
        Licencia de conducir
    </option>

    <option value="CURP" @selected(old('tipo_identificacion') === 'CURP')>
        CURP
    </option>
</select>
                        </div>


                        {{-- Razón social --}}
                        <div>

                            <label
                                for="razon_social"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Razón social
                            </label>

                            <input
                                id="razon_social"
                                name="razon_social"
                                type="text"
                                value="{{ old('razon_social') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>


                        {{-- Régimen fiscal --}}
                        <div>

                            <label
                                for="regimen_fiscal"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Régimen fiscal
                            </label>

                            <select
    id="regimen_fiscal"
    name="regimen_fiscal"
    required
    class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
>
    <option value="">
        Selecciona un régimen fiscal
    </option>

    <option
        value="Régimen Simplificado de Confianza (RESICO)"
        @selected(old('regimen_fiscal') === 'Régimen Simplificado de Confianza (RESICO)')
    >
        Régimen Simplificado de Confianza (RESICO)
    </option>

    <option
        value="Sueldos y salarios"
        @selected(old('regimen_fiscal') === 'Sueldos y salarios')
    >
        Sueldos y salarios
    </option>

    <option
        value="Actividad empresarial"
        @selected(old('regimen_fiscal') === 'Actividad empresarial')
    >
        Actividad empresarial
    </option>

    <option
        value="Régimen de Incorporación Fiscal (RIF)"
        @selected(old('regimen_fiscal') === 'Régimen de Incorporación Fiscal (RIF)')
    >
        Régimen de Incorporación Fiscal (RIF)
    </option>

    <option
        value="Persona moral"
        @selected(old('regimen_fiscal') === 'Persona moral')
    >
        Persona moral
    </option>

    <option
        value="Sin obligaciones fiscales"
        @selected(old('regimen_fiscal') === 'Sin obligaciones fiscales')
    >
        Sin obligaciones fiscales
    </option>
</select>
                        </div>


                        {{-- Empresa --}}
                        <div class="md:col-span-2">

                            <label
                                for="empresa"
                                class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                            >
                                Empresa
                            </label>

                            <input
                                id="empresa"
                                name="empresa"
                                type="text"
                                value="{{ old('empresa') }}"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-slate-500 focus:ring-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>

                    </div>

                </section>


                {{-- Acciones --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('customers.index') }}"
                        class="rounded-xl border border-slate-200 bg-white px-6 py-3 text-center text-sm font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                    >
                        Guardar cliente
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


            async function buscarCodigoPostal(codigoPostal) {

                if (!/^\d{5}$/.test(codigoPostal)) {
                    return;
                }


                loading.classList.remove('hidden');
                errorMessage.classList.add('hidden');


                estadoInput.value = '';
                municipioInput.value = '';

                coloniaSelect.innerHTML = '';


                try {

                    const response = await fetch(
                        `/api/codigo-postal/${codigoPostal}`
                    );


                    if (!response.ok) {
                        throw new Error('Código postal no encontrado');
                    }


                    const responseData = await response.json();


                    /*
                    |--------------------------------------------------------------------------
                    | La API devuelve:
                    |
                    | {
                    |     success: true,
                    |     data: {
                    |         cp: "...",
                    |         estado: "...",
                    |         municipio: "...",
                    |         asentamientos: [...]
                    |     }
                    | }
                    |--------------------------------------------------------------------------
                    */

                    if (!responseData.success || !responseData.data) {
                        throw new Error('Respuesta inválida');
                    }


                    const data = responseData.data;


                    // Estado
                    estadoInput.value = data.estado ?? '';


                    // Municipio
                    municipioInput.value = data.municipio ?? '';


                    // Colonias
                    if (
                        Array.isArray(data.asentamientos) &&
                        data.asentamientos.length > 0
                    ) {

                        const placeholder = document.createElement('option');

                        placeholder.value = '';
                        placeholder.textContent = 'Selecciona una colonia';
                        placeholder.disabled = true;
                        placeholder.selected = true;

                        coloniaSelect.appendChild(placeholder);


                        data.asentamientos.forEach(asentamiento => {

                            const option = document.createElement('option');

                            option.value = asentamiento.nombre;
                            option.textContent = asentamiento.nombre;

                            coloniaSelect.appendChild(option);

                        });


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


                    coloniaSelect.innerHTML = '';


                    const option = document.createElement('option');

                    option.value = '';
                    option.textContent = 'No se encontraron colonias';
                    option.disabled = true;
                    option.selected = true;

                    coloniaSelect.appendChild(option);

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

                    buscarCodigoPostal(codigoPostal);

                }

            });


            @if(old('codigo_postal'))

                if (
                    /^\d{5}$/.test(
                        '{{ old('codigo_postal') }}'
                    )
                ) {

                    buscarCodigoPostal(
                        '{{ old('codigo_postal') }}'
                    );

                }

            @endif

        });

    </script>

</x-app-layout>