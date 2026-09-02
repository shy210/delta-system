<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Encabezado --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                        Administración
                    </p>

                    <h1 class="mt-1 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        Clientes
                    </h1>

                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                        Administra la información de los clientes registrados en Delta System.
                    </p>
                </div>

                <a
                    href="{{ route('customers.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                >
                    + Agregar cliente
                </a>
            </div>

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-400">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Lista vacía --}}
            @if($customers->isEmpty())

                <div class="min-h-[360px] rounded-2xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:px-10">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl dark:bg-slate-800">
                        👤
                    </div>

                    <h2 class="mt-5 text-xl font-bold text-slate-900 dark:text-white">
                        No hay clientes registrados
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Todavía no has agregado ningún cliente. Comienza registrando el primero.
                    </p>

                    <a
                        href="{{ route('customers.create') }}"
                        class="mt-6 inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                    >
                        Agregar primer cliente
                    </a>

                </div>

            @else

                {{-- Barra superior de la lista --}}
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">
                            Lista de clientes
                        </p>

                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            {{ $customers->count() }}
                            {{ $customers->count() === 1 ? 'cliente registrado' : 'clientes registrados' }}
                        </p>
                    </div>
                </div>

                {{-- Lista --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    {{-- Encabezados --}}
                    <div class="hidden border-b border-slate-200 bg-slate-50 px-6 py-4 dark:border-slate-800 dark:bg-slate-950/60 md:grid md:grid-cols-[2fr_1.4fr_1.5fr_1.4fr_auto] md:items-center md:gap-6">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Cliente
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Empresa
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Contacto
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Ubicación
                        </p>

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            Acciones
                        </p>

                    </div>

                    {{-- Clientes --}}
                    <div class="divide-y divide-slate-200 dark:divide-slate-800">

                        @foreach($customers as $customer)

                            <div class="group px-5 py-5 transition hover:bg-slate-50 dark:hover:bg-slate-800/40 md:px-6">

                                {{-- Desktop --}}
                                <div class="hidden md:grid md:grid-cols-[2fr_1.4fr_1.5fr_1.4fr_auto] md:items-center md:gap-6">

                                    {{-- Cliente --}}
                                    <div class="flex min-w-0 items-center gap-4">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-sm font-extrabold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                            {{ strtoupper(substr($customer->nombre, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-bold text-slate-900 dark:text-white">
                                                {{ $customer->nombre }}
                                                {{ $customer->apellido_paterno }}
                                                {{ $customer->apellido_materno }}
                                            </p>

                                            <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                                {{ $customer->correo }}
                                            </p>
                                        </div>

                                    </div>

                                    {{-- Empresa --}}
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-slate-700 dark:text-slate-200">
                                            {{ $customer->empresa }}
                                        </p>
                                    </div>

                                    {{-- Contacto --}}
                                    <div>
                                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                            {{ $customer->telefono }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            WhatsApp: {{ $customer->whatsapp }}
                                        </p>
                                    </div>

                                    {{-- Ubicación --}}
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-slate-700 dark:text-slate-200">
                                            {{ $customer->municipio }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                            {{ $customer->estado }}
                                        </p>
                                    </div>

                                    {{-- Acciones --}}
                                    <div class="flex items-center justify-end gap-2">

                                        <a
                                            href="{{ route('customers.show', $customer) }}"
                                            title="Ver detalles"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                                        >
                                            👁
                                        </a>

                                        <a
                                            href="{{ route('customers.edit', $customer) }}"
                                            title="Editar"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                                        >
                                            ✎
                                        </a>

                                        <form
                                            action="{{ route('customers.destroy', $customer) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Eliminar"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 text-red-500 transition hover:bg-red-50 hover:text-red-700 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/30"
                                            >
                                                🗑
                                            </button>
                                        </form>

                                    </div>

                                </div>

                                {{-- Móvil --}}
                                <div class="md:hidden">

                                    <div class="flex items-start gap-4">

                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-sm font-extrabold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                            {{ strtoupper(substr($customer->nombre, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-bold text-slate-900 dark:text-white">
                                                {{ $customer->nombre }}
                                                {{ $customer->apellido_paterno }}
                                                {{ $customer->apellido_materno }}
                                            </p>

                                            <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                                {{ $customer->correo }}
                                            </p>
                                        </div>

                                    </div>

                                    <div class="mt-5 grid grid-cols-2 gap-4">

                                        <div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                Empresa
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->empresa }}
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                Teléfono
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->telefono }}
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                WhatsApp
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->whatsapp }}
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                Ubicación
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                                {{ $customer->municipio }}, {{ $customer->estado }}
                                            </p>
                                        </div>

                                    </div>

                                    <div class="mt-5 grid grid-cols-3 gap-2">

                                        <a
                                            href="{{ route('customers.show', $customer) }}"
                                            class="rounded-lg border border-slate-200 px-3 py-2 text-center text-xs font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('customers.edit', $customer) }}"
                                            class="rounded-lg bg-slate-900 px-3 py-2 text-center text-xs font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('customers.destroy', $customer) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="w-full rounded-lg border border-red-200 px-3 py-2 text-xs font-bold text-red-500 transition hover:bg-red-50 hover:text-red-700 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/30"
                                            >
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        </div>
    </div>
</x-app-layout>