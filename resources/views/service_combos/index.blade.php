<x-app-layout>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-6">

                <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400">
                    Inventario
                </p>

                <div class="mt-1 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                            Servicios combo
                        </h1>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Administra servicios compuestos por productos del inventario.
                        </p>

                    </div>

                    <a
                        href="{{ route('service-combos.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>

                        Agregar servicio combo

                    </a>

                </div>

            </div>

            {{-- Navegación --}}
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

            {{-- Mensajes --}}
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

            {{-- Contenedor --}}
            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                {{-- Barra superior --}}
                <div class="border-b border-slate-200 p-5 dark:border-slate-800">

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                        <div>

                            <h2 class="font-bold text-slate-900 dark:text-white">
                                Servicios registrados
                            </h2>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Consulta, edita y administra los servicios combo.
                            </p>

                        </div>

                        {{-- Exportaciones --}}
                        <div class="flex flex-wrap gap-2">

                            <a
                                href="{{ route('service-combos.export-excel', ['search' => $search]) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300 dark:hover:bg-emerald-900/50"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6M8 13l2 2-2 2m8-4l-2 2 2 2" />
                                </svg>

                                Excel

                            </a>

                            <a
                                href="{{ route('service-combos.export-pdf', ['search' => $search]) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-xs font-bold text-red-700 transition hover:bg-red-100 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-300 dark:hover:bg-red-900/50"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
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

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 14h12v8H6z" />
                                </svg>

                                Imprimir

                            </button>

                        </div>

                    </div>

                    {{-- Buscador --}}
                    <form
                        method="GET"
                        action="{{ route('service-combos.index') }}"
                        class="mt-5"
                    >

                        <div class="relative">

                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Buscar por nombre o código..."
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

                {{-- Área de impresión --}}
                <div id="combos-print-area">

                    <div class="hidden px-6 py-5 print:block">

                        <h1 class="text-xl font-bold">
                            Servicios combo
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

                        <table class="min-w-[1000px] w-full text-left text-sm">

                            <thead class="border-y border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-950">

                                <tr>

                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">
                                        Código
                                    </th>

                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">
                                        Servicio
                                    </th>

                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">
                                        Productos
                                    </th>

                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">
                                        Precio
                                    </th>

                                    <th class="px-5 py-4 font-bold text-slate-600 dark:text-slate-300">
                                        Estado
                                    </th>

                                    <th class="px-5 py-4 text-right font-bold text-slate-600 dark:text-slate-300">
                                        Acciones
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">

                                @forelse ($serviceCombos as $combo)

                                    <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">

                                        {{-- Código --}}
                                        <td class="px-5 py-4">

                                            <span class="rounded-lg bg-slate-100 px-2.5 py-1 font-mono text-xs font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                                {{ $combo->codigo }}
                                            </span>

                                        </td>

                                        {{-- Nombre --}}
                                        <td class="px-5 py-4">

                                            <p class="font-semibold text-slate-900 dark:text-white">
                                                {{ $combo->nombre }}
                                            </p>

                                            @if ($combo->descripcion)

                                                <p class="mt-1 max-w-sm truncate text-xs text-slate-400">
                                                    {{ $combo->descripcion }}
                                                </p>

                                            @endif

                                        </td>

                                        {{-- Productos --}}
                                        <td class="px-5 py-4">

                                            <span class="font-semibold text-slate-700 dark:text-slate-300">
                                                {{ $combo->productos->count() }}
                                                {{ $combo->productos->count() === 1 ? 'producto' : 'productos' }}
                                            </span>

                                        </td>

                                        {{-- Precio --}}
                                        <td class="px-5 py-4">

                                            <span class="font-bold text-slate-900 dark:text-white">
                                                ${{ number_format((float) $combo->precio, 2) }}
                                            </span>

                                        </td>

                                        {{-- Estado --}}
                                        <td class="px-5 py-4">

                                            @if ($combo->activo)

                                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                                    Activo
                                                </span>

                                            @else

                                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                                    Inactivo
                                                </span>

                                            @endif

                                        </td>

                                        {{-- Acciones --}}
                                        <td class="px-5 py-4">

                                            <div class="flex justify-end gap-2">

                                                {{-- Ver --}}
                                                <a
                                                    href="{{ route('service-combos.show', $combo) }}"
                                                    title="Ver"
                                                    class="rounded-lg border border-slate-200 p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                                                >

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor"
                                                         stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>

                                                </a>

                                                {{-- Editar --}}
                                                <a
                                                    href="{{ route('service-combos.edit', $combo) }}"
                                                    title="Editar"
                                                    class="rounded-lg border border-cyan-200 p-2 text-cyan-600 transition hover:bg-cyan-50 dark:border-cyan-900/50 dark:text-cyan-400 dark:hover:bg-cyan-950/40"
                                                >

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor"
                                                         stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                    </svg>

                                                </a>

                                                {{-- Eliminar --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('service-combos.destroy', $combo) }}"
                                                    onsubmit="return confirm('¿Deseas eliminar este servicio combo?')"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        title="Eliminar"
                                                        class="rounded-lg border border-slate-200 p-2 text-slate-500 transition hover:bg-slate-100 hover:text-red-600 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-red-400"
                                                    >

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="h-4 w-4"
                                                             fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke="currentColor"
                                                             stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4h8v2m-7 0v14m6-14v14M5 6l1 15h12l1-15" />
                                                        </svg>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="px-6 py-16 text-center">

                                            <p class="font-bold text-slate-900 dark:text-white">
                                                No hay servicios combo registrados
                                            </p>

                                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                                Comienza agregando tu primer servicio combo.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    {{-- Móvil --}}
                    <div class="divide-y divide-slate-100 lg:hidden dark:divide-slate-800">

                        @forelse ($serviceCombos as $combo)

                            <div class="p-5">

                                <div class="flex items-start justify-between gap-4">

                                    <div class="min-w-0">

                                        <p class="truncate font-bold text-slate-900 dark:text-white">
                                            {{ $combo->nombre }}
                                        </p>

                                        <p class="mt-1 font-mono text-xs text-slate-500 dark:text-slate-400">
                                            {{ $combo->codigo }}
                                        </p>

                                    </div>

                                    @if ($combo->activo)

                                        <span class="shrink-0 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                            Activo
                                        </span>

                                    @else

                                        <span class="shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                            Inactivo
                                        </span>

                                    @endif

                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">

                                    <div>

                                        <p class="text-xs text-slate-400">
                                            Productos
                                        </p>

                                        <p class="font-bold text-slate-800 dark:text-slate-200">
                                            {{ $combo->productos->count() }}
                                        </p>

                                    </div>

                                    <div>

                                        <p class="text-xs text-slate-400">
                                            Precio
                                        </p>

                                        <p class="font-bold text-slate-800 dark:text-slate-200">
                                            ${{ number_format((float) $combo->precio, 2) }}
                                        </p>

                                    </div>

                                </div>

                                @if ($combo->descripcion)

                                    <div class="mt-4 rounded-xl bg-slate-50 p-3 text-sm text-slate-600 dark:bg-slate-950 dark:text-slate-400">
                                        {{ $combo->descripcion }}
                                    </div>

                                @endif

                                <div class="mt-4 flex flex-wrap gap-2">

                                    <a
                                        href="{{ route('service-combos.show', $combo) }}"
                                        class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-bold text-slate-600 dark:border-slate-700 dark:text-slate-300"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('service-combos.edit', $combo) }}"
                                        class="rounded-xl border border-cyan-200 px-3 py-2 text-xs font-bold text-cyan-700 dark:border-cyan-900/50 dark:text-cyan-400"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('service-combos.destroy', $combo) }}"
                                        onsubmit="return confirm('¿Deseas eliminar este servicio combo?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-xl border border-red-200 px-3 py-2 text-xs font-bold text-red-700 dark:border-red-900/50 dark:text-red-400"
                                        >
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @empty

                            <div class="px-6 py-16 text-center">

                                <p class="font-bold text-slate-900 dark:text-white">
                                    No hay servicios combo registrados
                                </p>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    Comienza agregando tu primer servicio combo.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

                {{-- Paginación --}}
                @if ($serviceCombos->hasPages())

                    <div class="border-t border-slate-200 p-5 dark:border-slate-800">
                        {{ $serviceCombos->links() }}
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

            #combos-print-area,
            #combos-print-area * {
                visibility: visible !important;
            }

            #combos-print-area {
                position: absolute;
                inset: 0;
                width: 100%;
            }

            #combos-print-area table {
                font-size: 10px;
            }

            #combos-print-area .hidden.print\:block {
                display: block !important;
            }

        }
    </style>

</x-app-layout>