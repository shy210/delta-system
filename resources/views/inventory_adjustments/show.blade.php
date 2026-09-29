<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400">
                        Inventario / Ajustes
                    </p>

                    <h1 class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">
                        Detalle del ajuste
                    </h1>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Consulta toda la información del movimiento.
                    </p>
                </div>

                <a
                    href="{{ route('inventory-adjustments.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200"
                >
                    Regresar
                </a>
            </div>

            <div class="space-y-6">

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Tipo de movimiento
                            </p>

                            <div class="mt-2">
                                @if ($inventoryAdjustment->tipo === 'entrada')
                                    <span class="inline-flex rounded-full bg-emerald-100 px-4 py-2 text-sm font-bold text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                        Entrada
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-sm font-bold text-orange-700 dark:bg-orange-950/50 dark:text-orange-300">
                                        Salida
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            @if ($inventoryAdjustment->estatus === 'aprobado')
                                <span class="inline-flex rounded-full bg-emerald-100 px-4 py-2 text-sm font-bold text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                    Aprobado
                                </span>
                            @elseif ($inventoryAdjustment->estatus === 'rechazado')
                                <span class="inline-flex rounded-full bg-red-100 px-4 py-2 text-sm font-bold text-red-700 dark:bg-red-950/50 dark:text-red-300">
                                    Rechazado
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-sm font-bold text-amber-700 dark:bg-amber-950/50 dark:text-amber-300">
                                    Pendiente
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Información del producto
                    </h2>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Producto
                            </p>

                            <p class="mt-1 font-semibold text-slate-900 dark:text-white">
                                {{ $inventoryAdjustment->producto?->nombre ?? 'Producto eliminado' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Código de barras
                            </p>

                            <p class="mt-1 font-semibold text-slate-900 dark:text-white">
                                {{ $inventoryAdjustment->codigo_barras ?? $inventoryAdjustment->producto?->codigo ?? '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Cantidad
                            </p>

                            <p class="mt-1 text-xl font-bold text-slate-900 dark:text-white">
                                {{ number_format((float) $inventoryAdjustment->cantidad, 2) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Existencia actual
                            </p>

                            <p class="mt-1 text-xl font-bold text-cyan-600 dark:text-cyan-400">
                                {{ number_format((float) ($inventoryAdjustment->producto?->stock ?? 0), 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Información del movimiento
                    </h2>

                    <div class="mt-6">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Operación / descripción
                        </p>

                        <div class="mt-2 rounded-2xl bg-slate-50 p-4 text-sm text-slate-700 dark:bg-slate-950 dark:text-slate-300">
                            {{ $inventoryAdjustment->descripcion ?: 'Ajuste de inventario' }}
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Registro y aprobación
                    </h2>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Usuario registro
                            </p>

                            <p class="mt-1 font-semibold text-slate-900 dark:text-white">
                                {{ $inventoryAdjustment->usuarioRegistro?->name ?? '—' }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $inventoryAdjustment->created_at?->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Usuario aprobó
                            </p>

                            <p class="mt-1 font-semibold text-slate-900 dark:text-white">
                                {{ $inventoryAdjustment->usuarioAprobo?->name ?? 'Pendiente' }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $inventoryAdjustment->fecha_aprobacion?->format('d/m/Y H:i') ?? 'Pendiente' }}
                            </p>
                        </div>
                    </div>
                </div>

                @if ($inventoryAdjustment->estatus === 'pendiente')
                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

                        <form
                            method="POST"
                            action="{{ route('inventory-adjustments.reject', $inventoryAdjustment) }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                onclick="return confirm('¿Deseas rechazar este ajuste?')"
                                class="w-full rounded-xl border border-red-200 bg-white px-5 py-3 text-sm font-bold text-red-700 transition hover:bg-red-50 dark:border-red-900/50 dark:bg-slate-900 dark:text-red-400 dark:hover:bg-red-950/30 sm:w-auto"
                            >
                                Rechazar
                            </button>
                        </form>

                        <form
                            method="POST"
                            action="{{ route('inventory-adjustments.approve', $inventoryAdjustment) }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                onclick="return confirm('¿Deseas aprobar este ajuste? La existencia del producto será actualizada.')"
                                class="w-full rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200 sm:w-auto"
                            >
                                Aprobar ajuste
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>