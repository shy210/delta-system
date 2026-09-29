<x-app-layout>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-6">
                <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400">
                    Inventario
                </p>

                <div class="mt-1 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                            Agregar servicio combo
                        </h1>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Crea un servicio compuesto por uno o varios productos del inventario.
                        </p>
                    </div>

                    <a
                        href="{{ route('service-combos.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>

                        Regresar
                    </a>

                </div>
            </div>

            {{-- Navegación del inventario --}}
            <div class="mb-6 overflow-x-auto">
                <div class="flex min-w-max gap-2 rounded-2xl border border-slate-200 bg-white p-2 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <a
                        href="{{ route('products.index') }}"
                        class="rounded-xl px-4 py-2 text-sm font-bold text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                    >
                        Productos
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="rounded-xl px-4 py-2 text-sm font-bold text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                    >
                        Categorías
                    </a>

                    <a
                        href="{{ route('suppliers.index') }}"
                        class="rounded-xl px-4 py-2 text-sm font-bold text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                    >
                        Proveedores
                    </a>

                    <a
                        href="{{ route('inventory-adjustments.index') }}"
                        class="rounded-xl px-4 py-2 text-sm font-bold text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                    >
                        Ajustes
                    </a>

                    <a
                        href="{{ route('service-combos.index') }}"
                        class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white dark:bg-white dark:text-slate-900"
                    >
                        Servicios combo
                    </a>

                </div>
            </div>

            {{-- Errores --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-950/30">

                    <p class="font-bold text-red-700 dark:text-red-300">
                        Revisa los siguientes datos:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600 dark:text-red-400">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif

            <form
                method="POST"
                action="{{ route('service-combos.store') }}"
                x-data="serviceComboForm()"
                x-init="init()"
                class="space-y-6"
            >

                @csrf

                {{-- Datos generales --}}
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Datos generales
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Define la información principal del servicio combo.
                        </p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">

                        {{-- Código --}}
                        <div>
                            <label class="form-label">
                                Código
                            </label>

                            <div class="flex gap-2">

                                <input
                                    type="text"
                                    name="codigo"
                                    x-model="codigo"
                                    readonly
                                    class="form-input bg-slate-100 font-bold dark:bg-slate-800"
                                >

                                <button
                                    type="button"
                                    @click="generateCode()"
                                    title="Generar otro código"
                                    class="inline-flex shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 text-slate-600 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-5 w-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h5M20 20v-5h-5M5 4a9 9 0 0114 1M19 20a9 9 0 01-14-1" />
                                    </svg>
                                </button>

                            </div>

                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                Se genera automáticamente.
                            </p>
                        </div>

                        {{-- Nombre --}}
                        <div>
                            <label class="form-label">
                                Nombre del servicio
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                class="form-input"
                                placeholder="Ej. Cambio de pantalla"
                                required
                            >
                        </div>

                        {{-- Precio --}}
                        <div>
                            <label class="form-label">
                                Precio del servicio
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">
                                    $
                                </span>

                                <input
                                    type="number"
                                    name="precio_venta"
                                    value="{{ old('precio_venta') }}"
                                    step="0.01"
                                    min="0"
                                    class="form-input pl-8"
                                    placeholder="0.00"
                                    required
                                >

                            </div>
                        </div>

                        {{-- Estado --}}
                        <div>
                            <label class="form-label">
                                Estado
                            </label>

                            <select
                                name="activo"
                                class="form-input"
                            >
                                <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>
                                    Activo
                                </option>

                                <option value="0" {{ old('activo') === '0' ? 'selected' : '' }}>
                                    Inactivo
                                </option>
                            </select>
                        </div>

                        {{-- Descripción --}}
                        <div class="md:col-span-2">

                            <label class="form-label">
                                Descripción
                            </label>

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="form-input"
                                placeholder="Describe en qué consiste el servicio..."
                            >{{ old('descripcion') }}</textarea>

                        </div>

                    </div>

                </div>

                {{-- Productos del combo --}}
                <div class="rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 p-6 dark:border-slate-800">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                                    Productos del combo
                                </h2>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    Selecciona los productos y la cantidad que utilizará este servicio.
                                </p>
                            </div>

                            <button
                                type="button"
                                @click="addProduct()"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>

                                Agregar producto
                            </button>

                        </div>

                    </div>

                    <div class="p-6">

                        <div class="space-y-4">

                            <template x-for="(item, index) in items" :key="item.key">

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-950">

                                    <div class="grid gap-4 md:grid-cols-12 md:items-end">

                                        {{-- Producto --}}
                                        <div class="md:col-span-7">

                                            <label class="form-label">
                                                Producto
                                            </label>

                                            <select
                                                :name="`productos[${index}][product_id]`"
                                                x-model="item.product_id"
                                                @change="updateItem(index)"
                                                class="form-input"
                                                required
                                            >

                                                <option value="">
                                                    Selecciona un producto
                                                </option>

                                                @foreach ($products as $product)

                                                    <option
                                                        value="{{ $product->id }}"
                                                        data-costo="{{ $product->costo_compra ?? 0 }}"
                                                    >
                                                        {{ $product->nombre }} — {{ $product->codigo }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        {{-- Cantidad --}}
                                        <div class="md:col-span-3">

                                            <label class="form-label">
                                                Cantidad
                                            </label>

                                            <input
                                                type="number"
                                                :name="`productos[${index}][cantidad]`"
                                                x-model="item.cantidad"
                                                @input="calculate()"
                                                min="0.01"
                                                step="0.01"
                                                class="form-input"
                                                required
                                            >

                                        </div>

                                        {{-- Eliminar --}}
                                        <div class="md:col-span-2">

                                            <button
                                                type="button"
                                                @click="removeProduct(index)"
                                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-3 text-sm font-bold text-red-600 transition hover:bg-red-50 dark:border-red-900/50 dark:bg-slate-900 dark:text-red-400 dark:hover:bg-red-950/30"
                                            >

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-4 w-4"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor"
                                                     stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-1 0V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2m-4 0h12" />
                                                </svg>

                                                Quitar

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </template>

                        </div>

                        {{-- Sin productos --}}
                        <div
                            x-show="items.length === 0"
                            x-cloak
                            class="rounded-2xl border border-dashed border-slate-300 px-6 py-12 text-center dark:border-slate-700"
                        >

                            <p class="font-bold text-slate-900 dark:text-white">
                                No hay productos agregados
                            </p>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Agrega al menos un producto para formar el servicio combo.
                            </p>

                            <button
                                type="button"
                                @click="addProduct()"
                                class="mt-4 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900"
                            >
                                Agregar producto
                            </button>

                        </div>

                    </div>

                </div>

                {{-- Resumen --}}
                <div class="rounded-3xl border border-cyan-200 bg-cyan-50 p-6 dark:border-cyan-900/50 dark:bg-cyan-950/20">

                    <div class="grid gap-6 sm:grid-cols-3">

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wide text-cyan-700 dark:text-cyan-400">
                                Productos
                            </p>

                            <p
                                class="mt-1 text-xl font-bold text-cyan-950 dark:text-cyan-100"
                                x-text="items.length"
                            >
                                0
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wide text-cyan-700 dark:text-cyan-400">
                                Unidades
                            </p>

                            <p
                                class="mt-1 text-xl font-bold text-cyan-950 dark:text-cyan-100"
                                x-text="totalUnits.toFixed(2)"
                            >
                                0.00
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wide text-cyan-700 dark:text-cyan-400">
                                Costo estimado
                            </p>

                            <p
                                class="mt-1 text-xl font-bold text-cyan-950 dark:text-cyan-100"
                            >
                                $<span x-text="totalCost.toFixed(2)">0.00</span>
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Botones --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('service-combos.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                    >
                        Guardar servicio combo
                    </button>

                </div>

            </form>

        </div>

    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .form-label {
            display: block;
            margin-bottom: .5rem;
            font-size: .875rem;
            font-weight: 700;
            color: rgb(51 65 85);
        }

        .dark .form-label {
            color: rgb(226 232 240);
        }

        .form-input {
            width: 100%;
            border-radius: .75rem;
            border: 1px solid rgb(226 232 240);
            background: white;
            padding: .75rem 1rem;
            font-size: .875rem;
            color: rgb(15 23 42);
            outline: none;
            transition: .2s;
        }

        .form-input:focus {
            border-color: rgb(6 182 212);
            box-shadow: 0 0 0 3px rgb(6 182 212 / .12);
        }

        .dark .form-input {
            border-color: rgb(51 65 85);
            background: rgb(15 23 42);
            color: rgb(241 245 249);
        }

        .dark .form-input:focus {
            border-color: rgb(34 211 238);
        }
    </style>

    <script>
        function serviceComboForm() {
            return {
                codigo: @js(old('codigo', '')),

                items: [],

                totalUnits: 0,

                totalCost: 0,

                init() {

                    this.generateCode();

                    @if (old('productos'))
                        this.items = @js(old('productos')).map((item, index) => ({
                            key: Date.now() + index,
                            product_id: item.product_id ?? '',
                            cantidad: item.cantidad ?? 1,
                            costo: 0,
                        }));
                    @endif

                    if (this.items.length === 0) {
                        this.addProduct();
                    }

                    this.calculate();
                },

                generateCode() {

                    const characters =
                        'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

                    let code = 'SC-';

                    for (let i = 0; i < 6; i++) {
                        code += characters.charAt(
                            Math.floor(
                                Math.random() * characters.length
                            )
                        );
                    }

                    this.codigo = code;
                },

                addProduct() {

                    this.items.push({
                        key: Date.now() + Math.random(),
                        product_id: '',
                        cantidad: 1,
                        costo: 0,
                    });

                    this.calculate();
                },

                removeProduct(index) {

                    this.items.splice(index, 1);

                    this.calculate();
                },

                updateItem(index) {

                    const item = this.items[index];

                    const selects =
                        this.$root.querySelectorAll(
                            'select[name^="productos["]'
                        );

                    const select = selects[index];

                    if (!select) {
                        return;
                    }

                    const option =
                        select.options[select.selectedIndex];

                    item.costo =
                        parseFloat(
                            option?.dataset.costo || 0
                        );

                    this.calculate();
                },

                calculate() {

                    this.totalUnits = this.items.reduce(
                        (total, item) =>
                            total +
                            (parseFloat(item.cantidad) || 0),
                        0
                    );

                    this.totalCost = this.items.reduce(
                        (total, item) =>
                            total +
                            (
                                (parseFloat(item.cantidad) || 0) *
                                (parseFloat(item.costo) || 0)
                            ),
                        0
                    );
                }
            };
        }
    </script>

</x-app-layout>