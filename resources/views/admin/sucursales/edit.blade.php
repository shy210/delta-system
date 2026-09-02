<x-app-layout>


<div class="min-h-screen bg-slate-50 px-4 py-8 transition-colors duration-300 dark:bg-slate-950 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-4xl">

        {{-- Encabezado --}}
        <div class="mb-10">
            <div class="mb-3 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-slate-900 dark:bg-white"></span>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                    Administración
                </span>
            </div>

            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                Editar sucursal
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                Actualiza la información de {{ $branch->nombre }}.
            </p>
        </div>


        {{-- Errores de validación --}}
        @if($errors->any())
            <div class="mb-8 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-800 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-300">

                <p class="mb-2 text-sm font-bold">
                    Revisa la información ingresada
                </p>

                <ul class="list-inside list-disc space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        {{-- Formulario --}}
        <form
            action="{{ route('branches.update', $branch) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf
            @method('PUT')


            {{-- Información general --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800">

                    <h2 class="text-lg font-extrabold text-slate-900 dark:text-white">
                        Información general
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Información principal de la sucursal.
                    </p>

                </div>


                <div class="grid gap-6 p-6 sm:grid-cols-2">

                    {{-- Nombre --}}
                    <div class="sm:col-span-2">

                        <label
                            for="nombre"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Nombre de la sucursal
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre', $branch->nombre) }}"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                    </div>


                    {{-- País --}}
                    <div>

                        <label
                            for="pais"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            País
                        </label>

                        <select
                            id="pais"
                            name="pais"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                            @foreach([
                                'México',
                                'Estados Unidos',
                                'Canadá',
                                'España',
                                'Colombia',
                                'Argentina',
                                'Chile',
                                'Perú',
                                'Brasil',
                                'Otro'
                            ] as $pais)

                                <option
                                    value="{{ $pais }}"
                                    @selected(old('pais', $branch->pais) === $pais)
                                >
                                    {{ $pais }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Moneda --}}
                    <div>

                        <label
                            for="moneda"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Moneda
                        </label>

                        <select
                            id="moneda"
                            name="moneda"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                            <option value="MXN" @selected(old('moneda', $branch->moneda) === 'MXN')}>
                                MXN - Peso mexicano
                            </option>

                            <option value="USD" @selected(old('moneda', $branch->moneda) === 'USD')}>
                                USD - Dólar estadounidense
                            </option>

                            <option value="EUR" @selected(old('moneda', $branch->moneda) === 'EUR')}>
                                EUR - Euro
                            </option>

                        </select>

                    </div>


                    {{-- Teléfono --}}
                    <div>

                        <label
                            for="telefono"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Teléfono
                        </label>

                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            value="{{ old('telefono', $branch->telefono) }}"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                    </div>


                    {{-- Logo --}}
                    <div>

                        <label
                            for="logo"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Logo
                        </label>

                        <input
                            type="file"
                            id="logo"
                            name="logo"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block w-full rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-900 file:px-4 file:py-3 file:text-sm file:font-bold file:text-white hover:file:bg-slate-800 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:file:bg-white dark:file:text-slate-900"
                        >

                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                            Selecciona una nueva imagen únicamente si deseas reemplazar el logo actual.
                        </p>

                    </div>


                    {{-- Descripción --}}
                    <div class="sm:col-span-2">

                        <label
                            for="descripcion"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Descripción
                        </label>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            rows="4"
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >{{ old('descripcion', $branch->descripcion) }}</textarea>

                    </div>

                </div>

            </section>


            {{-- Dirección --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-800">

                    <h2 class="text-lg font-extrabold text-slate-900 dark:text-white">
                        Dirección
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Ubicación física de la sucursal.
                    </p>

                </div>


                <div class="grid gap-6 p-6 sm:grid-cols-2">

                    {{-- Código postal --}}
                    <div>

                        <label
                            for="codigo_postal"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Código postal
                        </label>

                        <input
                            type="text"
                            id="codigo_postal"
                            name="codigo_postal"
                            value="{{ old('codigo_postal', $branch->codigo_postal) }}"
                            required
                            maxlength="10"
                            inputmode="numeric"
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                        <p
                            id="cp-loading"
                            class="mt-2 hidden text-xs text-slate-500 dark:text-slate-400"
                        >
                            Consultando código postal...
                        </p>

                        <p
                            id="cp-error"
                            class="mt-2 hidden text-xs font-semibold text-red-600 dark:text-red-400"
                        >
                            No se encontró información para este código postal.
                        </p>

                    </div>


                    {{-- Estado --}}
                    <div>

                        <label
                            for="estado"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Estado
                        </label>

                        <input
                            type="text"
                            id="estado"
                            name="estado"
                            value="{{ old('estado', $branch->estado) }}"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                    </div>


                    {{-- Municipio --}}
                    <div>

                        <label
                            for="municipio"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Municipio
                        </label>

                        <input
                            type="text"
                            id="municipio"
                            name="municipio"
                            value="{{ old('municipio', $branch->municipio) }}"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                    </div>


                    {{-- Colonia --}}
                    <div>

                        <label
                            for="colonia"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Colonia
                        </label>

                        <select
                            id="colonia"
                            name="colonia"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >
                            <option value="{{ old('colonia', $branch->colonia) }}" selected>
                                {{ old('colonia', $branch->colonia) }}
                            </option>
                        </select>

                    </div>


                    {{-- Calle --}}
                    <div class="sm:col-span-2">

                        <label
                            for="calle"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Calle
                        </label>

                        <input
                            type="text"
                            id="calle"
                            name="calle"
                            value="{{ old('calle', $branch->calle) }}"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                    </div>


                    {{-- Número exterior --}}
                    <div>

                        <label
                            for="numero_exterior"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Número exterior
                        </label>

                        <input
                            type="text"
                            id="numero_exterior"
                            name="numero_exterior"
                            value="{{ old('numero_exterior', $branch->numero_exterior) }}"
                            required
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                    </div>


                    {{-- Número interior --}}
                    <div>

                        <label
                            for="numero_interior"
                            class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300"
                        >
                            Número interior
                        </label>

                        <input
                            type="text"
                            id="numero_interior"
                            name="numero_interior"
                            value="{{ old('numero_interior', $branch->numero_interior) }}"
                            class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:border-white dark:focus:ring-white"
                        >

                    </div>

                </div>

            </section>


            {{-- Botones --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('branches.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition duration-200 hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
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
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    Guardar cambios

                </button>

            </div>

        </form>

    </div>

</div>


{{-- API de códigos postales --}}
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


        const coloniaActual = @json(old('colonia', $branch->colonia));


        async function buscarCodigoPostal(codigoPostal, conservarColonia = false) {

            if (!/^\d{5}$/.test(codigoPostal)) {
                return;
            }

            loading.classList.remove('hidden');
            errorMessage.classList.add('hidden');

            try {

                const response = await fetch(
                    `https://postali.app/api/v1/mx/cp/${codigoPostal}`
                );

                if (!response.ok) {
                    throw new Error('Código postal no encontrado');
                }

                const data = await response.json();


                // Estado
                estadoInput.value = data.estado ?? '';


                // Municipio
                municipioInput.value = data.municipio ?? '';


                // Colonias
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

                        /*
                         * Si estamos cargando el CP que ya tenía
                         * la sucursal, conservamos su colonia.
                         */
                        if (
                            conservarColonia &&
                            asentamiento.nombre === coloniaActual
                        ) {
                            option.selected = true;
                        }

                        coloniaSelect.appendChild(option);

                    });


                    /*
                     * Si la colonia anterior ya no pertenece
                     * al nuevo código postal, no seleccionamos
                     * ninguna automáticamente.
                     */
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


        /*
         * Al escribir un nuevo código postal
         */
        codigoPostalInput.addEventListener('input', () => {

            const codigoPostal = codigoPostalInput.value
                .replace(/\D/g, '')
                .slice(0, 5);

            codigoPostalInput.value = codigoPostal;


            if (codigoPostal.length === 5) {

                /*
                 * Como el usuario está escribiendo un nuevo CP,
                 * cargamos las colonias pero NO seleccionamos ninguna.
                 */
                buscarCodigoPostal(codigoPostal, false);

            }

        });


        /*
         * Al entrar a editar:
         *
         * Si el código postal ya tiene 5 dígitos,
         * consultamos la API automáticamente.
         *
         * Conservamos la colonia que ya estaba guardada
         * si pertenece a ese código postal.
         */
        const codigoPostalInicial = codigoPostalInput.value
            .replace(/\D/g, '')
            .slice(0, 5);

        if (codigoPostalInicial.length === 5) {

            buscarCodigoPostal(codigoPostalInicial, true);

        }

    });

</script>

</x-app-layout>
