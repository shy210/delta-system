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

                <div class="mt-5 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-slate-900 text-xl font-extrabold text-white dark:bg-white dark:text-slate-900">
                            {{ strtoupper(substr($customer->nombre, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                Cliente
                            </p>

                            <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-3xl">
                                {{ $customer->nombre }}
                                {{ $customer->apellido_paterno }}
                                {{ $customer->apellido_materno }}
                            </h1>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ $customer->empresa }}
                            </p>
                        </div>

                    </div>

                    <div class="flex gap-2">

                        <a
                            href="{{ route('customers.edit', $customer) }}"
                            class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
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
                                class="inline-flex items-center justify-center rounded-xl border border-red-200 px-5 py-3 text-sm font-bold text-red-500 transition hover:bg-red-50 hover:text-red-700 dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-950/30"
                            >
                                Eliminar
                            </button>
                        </form>

                    </div>

                </div>
            </div>

            <div class="space-y-6">

                {{-- Información personal --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Información personal
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Datos generales del cliente.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2 lg:grid-cols-3">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Nombre completo
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->nombre }}
                                {{ $customer->apellido_paterno }}
                                {{ $customer->apellido_materno }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Fecha de nacimiento
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->fecha_nacimiento?->format('d/m/Y') ?? 'No disponible' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Tipo de identificación
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->tipo_identificacion }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Contacto --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Contacto
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Información para comunicarse con el cliente.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Teléfono
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->telefono }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                WhatsApp
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->whatsapp }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Correo
                            </p>

                            <p class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->correo }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Contacto alternativo
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->contacto_alternativo ?: 'No registrado' }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Domicilio --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Domicilio
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Dirección registrada del cliente.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2 lg:grid-cols-3">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                País
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->pais }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Código postal
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->codigo_postal }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Estado
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->estado }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Municipio
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->municipio }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Colonia
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->colonia }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Calle
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->calle }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                No. exterior
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->numero_exterior }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                No. interior
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->numero_interior ?: 'No registrado' }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Información comercial --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Información comercial
                        </h2>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Información fiscal y comercial del cliente.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2 lg:grid-cols-3">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Empresa
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->empresa }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Razón social
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->razon_social }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Precio
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->precio }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Régimen fiscal
                            </p>

                            <p class="mt-2 text-sm font-semibold text-slate-800 dark:text-slate-200">
                                {{ $customer->regimen_fiscal }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Cuenta del sistema --}}
                @if($customer->user)
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

                        <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-800">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                                Cuenta del sistema
                            </h2>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Información de acceso asociada al cliente.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2">

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Correo de acceso
                                </p>

                                <p class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $customer->user->email }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Rol
                                </p>

                                <p class="mt-2 text-sm font-semibold capitalize text-slate-800 dark:text-slate-200">
                                    {{ $customer->user->role }}
                                </p>
                            </div>

                        </div>

                    </div>
                @endif

            </div>

            {{-- Acciones inferiores --}}
            <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('customers.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800"
                >
                    Volver a clientes
                </a>

                <a
                    href="{{ route('customers.edit', $customer) }}"
                    class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white transition hover:bg-slate-800 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-100"
                >
                    Editar cliente
                </a>

            </div>

        </div>
    </div>
</x-app-layout>

