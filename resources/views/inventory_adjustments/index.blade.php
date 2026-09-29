<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="mb-6">
                <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400">
                    Inventario
                </p>

                <div class="mt-1 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                            Ajustes
                        </h1>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Registra y administra entradas y salidas de inventario.
                        </p>
                    </div>

                    <a
                        href="{{ route('inventory-adjustments.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>

                        Agregar ajuste
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
                        class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white dark:bg-white dark:text-slate-900"
                    >
                        Ajustes
                    </a>

                    <span class="rounded-xl px-4 py-2 text-sm font-bold text-slate-400">
                        Servicios combo
                    </span>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->has('adjustment'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-300">
                    {{ $errors->first('adjustment') }}
                </div>
            @endif

            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                <div class="border-b border-slate-200 p-5 dark:border-slate-800">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                        <div>
                            <h2 class="font-bold text-slate-900 dark:text-white">
                                Movimientos de inventario
                            </h2>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Consulta, aprueba o rechaza los ajustes registrados.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">

                            <a
                                href="{{ route('inventory-adjustments.export-excel', ['search' => $search]) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300 dark:hover:bg-emerald-900/50"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6M8 13l2 2-2 2m8-4l-2 2 2 2" />
                                </svg>

                                Excel
                            </a>

                            <a
                                href="{{ route('inventory-adjustments.export-pdf', ['search' => $search]) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-xs font-bold text-red-700 transition hover:bg-red-100 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-300 dark:hover:bg-red-900/50"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 2h9l5 5v15H6a2 2 0 01-2-2V4a2 2 0 012-2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6" />
                                </svg>

                                PDF
                            </a>

                            <button
                                type="button"
                                onclick="window.print()"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 14h12v8H6z" />
                                </svg>

                                Imprimir
                            </button>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('inventory-adjustments.index') }}" class="mt-5">
                        <div class="relative">
                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Buscar por producto, código, tipo, usuario o estatus..."
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-24 text-sm text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-4 focus:ring-cyan-500/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >

                            <button
                                type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900"
                            >
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>

                <div id="adjustments-print-area">

                    <div class="hidden px-6 py-5 print:block">
                        <h1 class="text-xl font-bold">
                            Ajustes de inventario
                        </h1>

                        <p class="text-sm text-slate-500">
                            Fecha de impresión: {{ now()->format('d/m/Y H:i') }}
                        </p>

                        @if ($search)
                            <p class="mt-1 text-sm text-slate-500">
                                Filtro: "{{ $search }}"
                            </p>
                        @endif
                    </div>

                    {{-- Escritorio --}}
                    <div class="hidden overflow-x-auto lg:block">
                        <table class="min-w-[1200px] w-full text-left text-sm">
                            <thead class="border-y border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-950">
                                <tr>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Tipo</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Operación</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Producto</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Código</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Fecha registro</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Usuario registro</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Usuario aprobó</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Fecha aprobó</th>
                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">Estatus</th>
                                    <th class="px-5 py-4 text-right font-bold text-slate-600 dark:text-slate-300">Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse ($adjustments as $adjustment)
                                    <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">

                                        <td class="px-5 py-4">
                                            @if ($adjustment->tipo === 'entrada')
                                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                                    Entrada
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700 dark:bg-orange-950/50 dark:text-orange-300">
                                                    Salida
                                                </span>
                                            @endif
                                        </td>

                                        <td class="max-w-xs px-5 py-4">
                                            <p class="truncate font-semibold text-slate-900 dark:text-white">
                                                {{ $adjustment->descripcion ?: 'Ajuste de inventario' }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                Cantidad: {{ number_format((float) $adjustment->cantidad, 2) }}
                                            </p>
                                        </td>

                                        <td class="px-5 py-4">
                                            <span class="font-semibold text-slate-900 dark:text-white">
                                                {{ $adjustment->producto?->nombre ?? 'Producto eliminado' }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 text-slate-500 dark:text-slate-400">
                                            {{ $adjustment->codigo_barras ?? $adjustment->producto?->codigo ?? '—' }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-500 dark:text-slate-400">
                                            {{ $adjustment->created_at?->format('d/m/Y H:i') }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-600 dark:text-slate-300">
                                            {{ $adjustment->usuarioRegistro?->name ?? '—' }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-600 dark:text-slate-300">
                                            {{ $adjustment->usuarioAprobo?->name ?? '—' }}
                                        </td>

                                        <td class="px-5 py-4 text-slate-500 dark:text-slate-400">
                                            {{ $adjustment->fecha_aprobacion?->format('d/m/Y H:i') ?? '—' }}
                                        </td>

                                        <td class="px-5 py-4">
                                            @if ($adjustment->estatus === 'aprobado')
                                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                                    Aprobado
                                                </span>
                                            @elseif ($adjustment->estatus === 'rechazado')
                                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700 dark:bg-red-950/50 dark:text-red-300">
                                                    Rechazado
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700 dark:bg-amber-950/50 dark:text-amber-300">
                                                    Pendiente
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="flex justify-end gap-2">

                                                <a
                                                    href="{{ route('inventory-adjustments.show', $adjustment) }}"
                                                    title="Ver"
                                                    class="rounded-lg border border-slate-200 p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                </a>

                                                @if ($adjustment->estatus === 'pendiente')
                                                    <form method="POST" action="{{ route('inventory-adjustments.approve', $adjustment) }}">
                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            title="Aprobar"
                                                            onclick="return confirm('¿Deseas aprobar este ajuste? La existencia del producto será actualizada.')"
                                                            class="rounded-lg border border-emerald-200 p-2 text-emerald-600 transition hover:bg-emerald-50 dark:border-emerald-900/50 dark:text-emerald-400 dark:hover:bg-emerald-950/40"
                                                        >
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="{{ route('inventory-adjustments.reject', $adjustment) }}">
                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            title="Rechazar"
                                                            onclick="return confirm('¿Deseas rechazar este ajuste?')"
                                                            class="rounded-lg border border-red-200 p-2 text-red-600 transition hover:bg-red-50 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/40"
                                                        >
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($adjustment->estatus !== 'aprobado')
                                                    <form
                                                        method="POST"
                                                        action="{{ route('inventory-adjustments.destroy', $adjustment) }}"
                                                        onsubmit="return confirm('¿Deseas eliminar este ajuste?')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            title="Eliminar"
                                                            class="rounded-lg border border-slate-200 p-2 text-slate-500 transition hover:bg-slate-100 hover:text-red-600 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-red-400"
                                                        >
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4h8v2m-7 0v14m6-14v14M5 6l1 15h12l1-15" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-16 text-center">
                                            <p class="font-bold text-slate-900 dark:text-white">
                                                No hay ajustes registrados
                                            </p>

                                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                                Comienza agregando un ajuste de inventario.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Móvil --}}
                    <div class="divide-y divide-slate-100 lg:hidden dark:divide-slate-800">
                        @forelse ($adjustments as $adjustment)
                            <div class="p-5">

                                <div class="flex items-start justify-between gap-4">

                                    <div class="min-w-0">
                                        <p class="truncate font-bold text-slate-900 dark:text-white">
                                            {{ $adjustment->producto?->nombre ?? 'Producto eliminado' }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            {{ $adjustment->codigo_barras ?? 'Sin código' }}
                                        </p>
                                    </div>

                                    @if ($adjustment->tipo === 'entrada')
                                        <span class="shrink-0 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                            Entrada
                                        </span>
                                    @else
                                        <span class="shrink-0 rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700 dark:bg-orange-950/50 dark:text-orange-300">
                                            Salida
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <p class="text-xs text-slate-400">Cantidad</p>
                                        <p class="font-bold text-slate-800 dark:text-slate-200">
                                            {{ number_format((float) $adjustment->cantidad, 2) }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-slate-400">Estatus</p>

                                        @if ($adjustment->estatus === 'aprobado')
                                            <p class="font-bold text-emerald-600 dark:text-emerald-400">Aprobado</p>
                                        @elseif ($adjustment->estatus === 'rechazado')
                                            <p class="font-bold text-red-600 dark:text-red-400">Rechazado</p>
                                        @else
                                            <p class="font-bold text-amber-600 dark:text-amber-400">Pendiente</p>
                                        @endif
                                    </div>

                                    <div>
                                        <p class="text-xs text-slate-400">Registro</p>
                                        <p class="font-semibold text-slate-700 dark:text-slate-300">
                                            {{ $adjustment->usuarioRegistro?->name ?? '—' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-slate-400">Fecha</p>
                                        <p class="font-semibold text-slate-700 dark:text-slate-300">
                                            {{ $adjustment->created_at?->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>

                                @if ($adjustment->descripcion)
                                    <div class="mt-4 rounded-xl bg-slate-50 p-3 text-sm text-slate-600 dark:bg-slate-950 dark:text-slate-400">
                                        {{ $adjustment->descripcion }}
                                    </div>
                                @endif

                                <div class="mt-4 flex flex-wrap gap-2">

                                    <a
                                        href="{{ route('inventory-adjustments.show', $adjustment) }}"
                                        class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-bold text-slate-600 dark:border-slate-700 dark:text-slate-300"
                                    >
                                        Ver
                                    </a>

                                    @if ($adjustment->estatus === 'pendiente')
                                        <form method="POST" action="{{ route('inventory-adjustments.approve', $adjustment) }}">
                                            @csrf

                                            <button
                                                type="submit"
                                                onclick="return confirm('¿Deseas aprobar este ajuste?')"
                                                class="rounded-xl border border-emerald-200 px-3 py-2 text-xs font-bold text-emerald-700 dark:border-emerald-900/50 dark:text-emerald-400"
                                            >
                                                Aprobar
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('inventory-adjustments.reject', $adjustment) }}">
                                            @csrf

                                            <button
                                                type="submit"
                                                onclick="return confirm('¿Deseas rechazar este ajuste?')"
                                                class="rounded-xl border border-red-200 px-3 py-2 text-xs font-bold text-red-700 dark:border-red-900/50 dark:text-red-400"
                                            >
                                                Rechazar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-16 text-center">
                                <p class="font-bold text-slate-900 dark:text-white">
                                    No hay ajustes registrados
                                </p>
                            </div>
                        @endforelse
                    </div>

                </div>

                @if ($adjustments->hasPages())
                    <div class="border-t border-slate-200 p-5 dark:border-slate-800">
                        {{ $adjustments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden !important;
            }

            #adjustments-print-area,
            #adjustments-print-area * {
                visibility: visible !important;
            }

            #adjustments-print-area {
                position: absolute;
                inset: 0;
                width: 100%;
            }

            #adjustments-print-area table {
                font-size: 10px;
            }

            #adjustments-print-area .hidden.print\:block {
                display: block !important;
            }
        }
    </style>
</x-app-layout>