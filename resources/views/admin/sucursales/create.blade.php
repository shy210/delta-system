<x-app-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 transition-colors duration-300 dark:bg-slate-950 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-5xl">

            {{-- Encabezado --}}
            <div class="mb-8">

                <a
                    href="{{ route('branches.index') }}"
                    class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
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
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    Volver a sucursales

                </a>

                <div class="mb-2 flex items-center gap-2">

                    <span class="h-2 w-2 rounded-full bg-slate-900 dark:bg-white"></span>

                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                        Administración
                    </span>

                </div>

                <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                    Nueva sucursal
                </h1>

                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                    Registra la información de una nueva sucursal en Delta System.
                </p>

            </div>


            {{-- Errores --}}
            @if($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 dark:border-red-900/50 dark:bg-red-950/30">

                    <div class="flex gap-3">

                        <svg
                            class="h-5 w-5 shrink-0 text-red-600 dark:text-red-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"
                            />
                        </svg>

                        <div>

                            <p class="font-bold text-red-800 dark:text-red-300">
                                Revisa la información
                            </p>

                            <ul class="mt-2 list-inside list-disc text-sm text-red-700 dark:text-red-400">

                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Formulario --}}
            <form
                method="POST"
                action="{{ route('branches.store') }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >

                @csrf


                {{-- Información general --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">

                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Información general
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Datos principales de la sucursal.
                        </p>

                    </div>


                    <div class="grid gap-6 p-6 md:grid-cols-2">

                        {{-- Nombre --}}
                        <div class="md:col-span-2">

                            <label
                                for="nombre"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Nombre de la sucursal
                            </label>

                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                required
                                placeholder="Ej. Delta Puebla Centro"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                        </div>


                        {{-- País --}}
                        <div>

                            <label
                                for="pais"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                País
                            </label>

                            <select
                                id="pais"
                                name="pais"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                                <option value="">
                                    Selecciona un país
                                </option>

                                <option value="México" {{ old('pais') === 'México' ? 'selected' : '' }}>
                                    México
                                </option>

                                <option value="Estados Unidos" {{ old('pais') === 'Estados Unidos' ? 'selected' : '' }}>
                                    Estados Unidos
                                </option>

                                <option value="Canadá" {{ old('pais') === 'Canadá' ? 'selected' : '' }}>
                                    Canadá
                                </option>

                                <option value="España" {{ old('pais') === 'España' ? 'selected' : '' }}>
                                    España
                                </option>

                                <option value="Colombia" {{ old('pais') === 'Colombia' ? 'selected' : '' }}>
                                    Colombia
                                </option>

                                <option value="Argentina" {{ old('pais') === 'Argentina' ? 'selected' : '' }}>
                                    Argentina
                                </option>

                                <option value="Chile" {{ old('pais') === 'Chile' ? 'selected' : '' }}>
                                    Chile
                                </option>

                                <option value="Perú" {{ old('pais') === 'Perú' ? 'selected' : '' }}>
                                    Perú
                                </option>

                                <option value="Brasil" {{ old('pais') === 'Brasil' ? 'selected' : '' }}>
                                    Brasil
                                </option>

                                <option value="Otro" {{ old('pais') === 'Otro' ? 'selected' : '' }}>
                                    Otro
                                </option>

                            </select>

                        </div>


                        {{-- Moneda --}}
                        <div>

                            <label
                                for="moneda"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Moneda
                            </label>

                            <select
                                id="moneda"
                                name="moneda"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                                <option value="">
                                    Selecciona una moneda
                                </option>

                                <option value="MXN" {{ old('moneda') === 'MXN' ? 'selected' : '' }}>
                                    MXN — Peso mexicano
                                </option>

                                <option value="USD" {{ old('moneda') === 'USD' ? 'selected' : '' }}>
                                    USD — Dólar estadounidense
                                </option>

                                <option value="EUR" {{ old('moneda') === 'EUR' ? 'selected' : '' }}>
                                    EUR — Euro
                                </option>

                            </select>

                        </div>


                        {{-- Teléfono --}}
                        <div>

                            <label
                                for="telefono"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Teléfono
                            </label>

                            <input
                                type="tel"
                                id="telefono"
                                name="telefono"
                                value="{{ old('telefono') }}"
                                required
                                placeholder="Ej. 222 123 4567"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                        </div>


                        {{-- Logo --}}
                        <div>

                            <label
                                for="logo"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Logo
                            </label>

                            <input
                                type="file"
                                id="logo"
                                name="logo"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="block w-full rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-400 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700"
                            >

                            <p class="mt-2 text-xs text-slate-400">
                                JPG, JPEG, PNG o WEBP. Máximo 2 MB.
                            </p>

                        </div>


                        {{-- Descripción --}}
                        <div class="md:col-span-2">

                            <label
                                for="descripcion"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Descripción
                            </label>

                            <textarea
                                id="descripcion"
                                name="descripcion"
                                rows="4"
                                placeholder="Describe brevemente esta sucursal..."
                                class="w-full resize-none rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >{{ old('descripcion') }}</textarea>

                        </div>

                    </div>

                </section>


                {{-- Dirección --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">

                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Dirección
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Ingresa el código postal para completar automáticamente la ubicación.
                        </p>

                    </div>


                    <div class="grid gap-6 p-6 md:grid-cols-2">


                        {{-- Código postal --}}
                        <div>

                            <label
                                for="codigo_postal"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Código postal
                            </label>

                            <div class="relative">

                                <input
                                    type="text"
                                    id="codigo_postal"
                                    name="codigo_postal"
                                    value="{{ old('codigo_postal') }}"
                                    required
                                    maxlength="5"
                                    inputmode="numeric"
                                    placeholder="Ej. 72000"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                                >

                                <div
                                    id="cp-loading"
                                    class="absolute right-3 top-1/2 hidden -translate-y-1/2"
                                >
                                    <svg
                                        class="h-5 w-5 animate-spin text-slate-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>

                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                                        ></path>
                                    </svg>
                                </div>

                            </div>

                            <p
                                id="cp-message"
                                class="mt-2 hidden text-xs"
                            ></p>

                        </div>


                        {{-- Estado --}}
                        <div>

                            <label
                                for="estado"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Estado
                            </label>

                            <input
                                type="text"
                                id="estado"
                                name="estado"
                                value="{{ old('estado') }}"
                                required
                                placeholder="Se completará automáticamente"
                                class="w-full rounded-xl border border-slate-300 bg-slate-100 px-4 py-3 text-sm text-slate-900 outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>


                        {{-- Municipio --}}
                        <div>

                            <label
                                for="municipio"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Municipio
                            </label>

                            <input
                                type="text"
                                id="municipio"
                                name="municipio"
                                value="{{ old('municipio') }}"
                                required
                                placeholder="Se completará automáticamente"
                                class="w-full rounded-xl border border-slate-300 bg-slate-100 px-4 py-3 text-sm text-slate-900 outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                            >

                        </div>


                        {{-- Colonia --}}
                        <div>

                            <label
                                for="colonia"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Colonia
                            </label>

                            <select
                                id="colonia"
                                name="colonia"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                                <option value="">
                                    Primero ingresa un código postal
                                </option>

                            </select>

                        </div>


                        {{-- Calle --}}
                        <div class="md:col-span-2">

                            <label
                                for="calle"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Calle
                            </label>

                            <input
                                type="text"
                                id="calle"
                                name="calle"
                                value="{{ old('calle') }}"
                                required
                                placeholder="Ej. Avenida Reforma"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                        </div>


                        {{-- Número exterior --}}
                        <div>

                            <label
                                for="numero_exterior"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Número exterior
                            </label>

                            <input
                                type="text"
                                id="numero_exterior"
                                name="numero_exterior"
                                value="{{ old('numero_exterior') }}"
                                required
                                placeholder="Ej. 123"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                        </div>


                        {{-- Número interior --}}
                        <div>

                            <label
                                for="numero_interior"
                                class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300"
                            >
                                Número interior
                                <span class="font-normal text-slate-400">
                                    (opcional)
                                </span>
                            </label>

                            <input
                                type="text"
                                id="numero_interior"
                                name="numero_interior"
                                value="{{ old('numero_interior') }}"
                                placeholder="Ej. Local 4"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-slate-500 dark:focus:ring-slate-800"
                            >

                        </div>

                    </div>

                </section>


                {{-- Acciones --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('branches.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/10 transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
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

                        Crear sucursal

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ============================================================
         API CÓDIGO POSTAL
    ============================================================= --}}

   <script>
    document.addEventListener('DOMContentLoaded', function () {

        const cpInput = document.getElementById('codigo_postal');
        const estadoInput = document.getElementById('estado');
        const municipioInput = document.getElementById('municipio');
        const coloniaSelect = document.getElementById('colonia');
        const loading = document.getElementById('cp-loading');
        const message = document.getElementById('cp-message');

        if (!cpInput) {
            return;
        }

        cpInput.addEventListener('input', function () {

            this.value = this.value.replace(/\D/g, '');

            if (this.value.length !== 5) {
                estadoInput.value = '';
                municipioInput.value = '';

                coloniaSelect.innerHTML = `
                    <option value="">
                        Primero ingresa un código postal
                    </option>
                `;

                coloniaSelect.disabled = true;
                message.classList.add('hidden');

                return;
            }

            buscarCodigoPostal(this.value);
        });


        async function buscarCodigoPostal(codigoPostal) {

            loading.classList.remove('hidden');

            message.classList.add('hidden');

            estadoInput.value = '';
            municipioInput.value = '';

            coloniaSelect.innerHTML = `
                <option value="">
                    Buscando colonias...
                </option>
            `;

            coloniaSelect.disabled = true;


            try {

                const response = await fetch(
                    `https://postali.app/api/v1/mx/cp/${codigoPostal}`
                );

                if (!response.ok) {
                    throw new Error('Código postal no encontrado');
                }

                const data = await response.json();

                if (!data || !data.estado || !data.municipio) {
                    throw new Error(
                        'No se encontró información para este código postal'
                    );
                }


                // ==========================================
                // ESTADO
                // ==========================================

                estadoInput.value = data.estado;


                // ==========================================
                // MUNICIPIO
                // ==========================================

                municipioInput.value = data.municipio;


                // ==========================================
                // COLONIAS
                // ==========================================

                coloniaSelect.innerHTML = `
                    <option value="">
                        Selecciona una colonia
                    </option>
                `;


                if (
                    Array.isArray(data.asentamientos) &&
                    data.asentamientos.length > 0
                ) {

                    data.asentamientos.forEach(asentamiento => {

                        const option = document.createElement('option');

                        option.value = asentamiento.nombre;

                        option.textContent = asentamiento.nombre;

                        coloniaSelect.appendChild(option);

                    });

                    coloniaSelect.disabled = false;

                } else {

                    coloniaSelect.innerHTML = `
                        <option value="">
                            No se encontraron colonias
                        </option>
                    `;

                    coloniaSelect.disabled = true;
                }


                // ==========================================
                // MENSAJE DE ÉXITO
                // ==========================================

                message.textContent =
                    'Código postal encontrado correctamente.';

                message.className =
                    'mt-2 text-xs text-emerald-600 dark:text-emerald-400';

                message.classList.remove('hidden');


            } catch (error) {

                console.error(
                    'Error al consultar código postal:',
                    error
                );


                estadoInput.value = '';
                municipioInput.value = '';


                coloniaSelect.innerHTML = `
                    <option value="">
                        No se encontraron colonias
                    </option>
                `;

                coloniaSelect.disabled = true;


                message.textContent =
                    'No se encontró información para este código postal. Verifica que sea correcto.';

                message.className =
                    'mt-2 text-xs text-red-600 dark:text-red-400';

                message.classList.remove('hidden');


            } finally {

                loading.classList.add('hidden');

            }

        }

    });
</script>

</x-app-layout>