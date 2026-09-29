<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400">
                        Inventario
                    </p>

                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                        Agregar ajuste
                    </h1>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Registra una entrada o salida de inventario para su posterior aprobación.
                    </p>
                </div>

                <a
                    href="{{ route('inventory-adjustments.index') }}"
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
                action="{{ route('inventory-adjustments.store') }}"
                x-data="adjustmentForm()"
                x-init="init()"
                class="space-y-6"
            >
                @csrf

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Datos del ajuste
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Define el movimiento que deseas registrar.
                        </p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">

                        {{-- Tipo --}}
                        <div>
                            <label class="form-label">
                                Tipo de ajuste
                            </label>

                            <select
                                name="tipo"
                                x-model="tipo"
                                class="form-input"
                                required
                            >
                                <option value="">Selecciona una opción</option>
                                <option value="entrada">Entrada</option>
                                <option value="salida">Salida</option>
                            </select>
                        </div>

                        {{-- Producto --}}
                        <div>
                            <label class="form-label">
                                Producto
                            </label>

                            <select
                                name="product_id"
                                x-model="productId"
                                @change="loadProduct"
                                class="form-input"
                                required
                            >
                                <option value="">
                                    Selecciona un producto
                                </option>

                                @forelse ($products as $product)
                                    <option
                                        value="{{ $product->id }}"
                                        data-codigo="{{ $product->codigo }}"
                                        data-stock="{{ $product->stock }}"
                                        data-nombre="{{ $product->nombre }}"
                                    >
                                        {{ $product->nombre }} — {{ $product->codigo }}
                                    </option>
                                @empty
                                    <option value="" disabled>
                                        No hay productos registrados
                                    </option>
                                @endforelse
                            </select>

                            @if ($products->isEmpty())
                                <p class="mt-2 text-xs font-medium text-red-500">
                                    No se encontraron productos en la base de datos.
                                </p>
                            @endif
                        </div>

                        {{-- Código de barras --}}
                        <div>
                            <label class="form-label">
                                Código de barras
                            </label>

                            <input
                                type="text"
                                name="codigo_barras"
                                x-model="codigo"
                                readonly
                                placeholder="Se llenará automáticamente"
                                class="form-input bg-slate-100 dark:bg-slate-800"
                            >

                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                Este código se obtiene automáticamente del producto seleccionado.
                            </p>
                        </div>

                        {{-- Cantidad --}}
                        <div>
                            <label class="form-label">
                                Cantidad
                            </label>

                            <input
                                type="number"
                                name="cantidad"
                                step="0.01"
                                min="0.01"
                                value="{{ old('cantidad') }}"
                                class="form-input"
                                required
                            >
                        </div>

                        {{-- Descripción --}}
                        <div class="md:col-span-2">
                            <label class="form-label">
                                Descripción / operación
                            </label>

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="form-input"
                                placeholder="Describe el motivo del ajuste..."
                            >{{ old('descripcion') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- Existencia actual --}}
                <div
                    x-show="productId"
                    x-cloak
                    class="rounded-3xl border border-cyan-200 bg-cyan-50 p-6 dark:border-cyan-900/50 dark:bg-cyan-950/20"
                >
                    <div class="flex gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-900/50 dark:text-cyan-300">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16" />
                            </svg>
                        </div>

                        <div>
                            <p class="font-bold text-cyan-900 dark:text-cyan-200">
                                Existencia actual
                            </p>

                            <p class="mt-1 text-sm text-cyan-800 dark:text-cyan-300">
                                <span x-text="stock"></span>
                                unidades disponibles.
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Botones --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('inventory-adjustments.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                    >
                        Guardar ajuste
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
        function adjustmentForm() {
            return {
                tipo: @js(old('tipo', '')),
                productId: @js(old('product_id', '')),
                codigo: @js(old('codigo_barras', '')),
                stock: '0',

                init() {
                    this.loadProduct();
                },

                loadProduct() {
                    const select = this.$root.querySelector(
                        'select[name="product_id"]'
                    );

                    if (!select) {
                        return;
                    }

                    const option = select.options[select.selectedIndex];

                    if (!option || !option.value) {
                        this.codigo = '';
                        this.stock = '0';
                        return;
                    }

                    this.codigo = option.dataset.codigo || '';
                    this.stock = option.dataset.stock || '0';
                }
            }
        }
    </script>
</x-app-layout>