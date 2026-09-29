<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-100">
                Ver proveedor
            </h2>

            <p class="text-sm text-slate-500 dark:text-slate-400">
                Consulta la información registrada del proveedor.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

                {{-- Encabezado --}}
                <div class="border-b border-slate-200 px-6 py-5 dark:border-slate-700">
                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300">
                            <svg
                                class="h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 7.5V6a2.25 2.25 0 0 0-2.25-2.25h-7.5A2.25 2.25 0 0 0 6 6v12a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 18v-1.5m0-9 3 3m0 0-3 3m3-3H9"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-semibold text-slate-800 dark:text-slate-100">
                                {{ $supplier->nombre }}
                            </h3>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Información del proveedor
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Información --}}
                <div class="grid gap-6 p-6 md:grid-cols-2">

                    {{-- Nombre --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Nombre
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-800 dark:text-slate-100">
                            {{ $supplier->nombre }}
                        </p>
                    </div>

                    {{-- WhatsApp --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            WhatsApp
                        </p>

                        <p class="mt-1 text-sm text-slate-700 dark:text-slate-200">
                            {{ $supplier->whatsapp ?: 'No registrado' }}
                        </p>
                    </div>

                    {{-- Teléfono --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Teléfono
                        </p>

                        <p class="mt-1 text-sm text-slate-700 dark:text-slate-200">
                            {{ $supplier->telefono ?: 'No registrado' }}
                        </p>
                    </div>

                    {{-- Correo --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Correo electrónico
                        </p>

                        <p class="mt-1 break-all text-sm text-slate-700 dark:text-slate-200">
                            {{ $supplier->correo ?: 'No registrado' }}
                        </p>
                    </div>

                    {{-- Dirección --}}
                    <div class="md:col-span-2">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Dirección
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm text-slate-700 dark:text-slate-200">
                            {{ $supplier->direccion ?: 'No registrada' }}
                        </p>
                    </div>

                    {{-- Fecha de registro --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Fecha de registro
                        </p>

                        <p class="mt-1 text-sm text-slate-700 dark:text-slate-200">
                            {{ $supplier->created_at?->format('d/m/Y H:i') ?? 'No disponible' }}
                        </p>
                    </div>

                    {{-- Última actualización --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Última actualización
                        </p>

                        <p class="mt-1 text-sm text-slate-700 dark:text-slate-200">
                            {{ $supplier->updated_at?->format('d/m/Y H:i') ?? 'No disponible' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Botones --}}
            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('suppliers.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
                >
                    Regresar
                </a>

                <a
                    href="{{ route('suppliers.edit', $supplier) }}"
                    class="inline-flex items-center justify-center rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700"
                >
                    <svg
                        class="mr-2 h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m16.862 3.487 3.65 3.65M4.5 19.5l4.2-.7L19.8 7.7a1.768 1.768 0 0 0-2.5-2.5L6.2 16.3l-.7 3.2Z"
                        />
                    </svg>

                    Editar proveedor
                </a>

            </div>

        </div>
    </div>
</x-app-layout>