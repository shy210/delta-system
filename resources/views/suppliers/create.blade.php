<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-100">
                Agregar proveedor
            </h2>

            <p class="text-sm text-slate-500 dark:text-slate-400">
                Registra la información del proveedor.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Mensajes de validación --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-950/30">
                    <div class="flex items-start gap-3">
                        <svg
                            class="mt-0.5 h-5 w-5 shrink-0 text-red-600 dark:text-red-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.007v.007H12v-.007Zm9 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                        </svg>

                        <div>
                            <p class="font-medium text-red-800 dark:text-red-300">
                                Revisa los siguientes campos:
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('suppliers.store') }}"
                class="space-y-6"
            >
                @csrf

                {{-- Datos del proveedor --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

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
                                    Datos del proveedor
                                </h3>

                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Información de contacto y ubicación.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-5 p-6 md:grid-cols-2">

                        {{-- Nombre --}}
                        <div class="md:col-span-2">
                            <label
                                for="nombre"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                Nombre
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="nombre"
                                name="nombre"
                                type="text"
                                value="{{ old('nombre') }}"
                                maxlength="255"
                                required
                                autofocus
                                placeholder="Nombre del proveedor"
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                            >

                            @error('nombre')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div>
                            <label
                                for="whatsapp"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                WhatsApp
                            </label>

                            <input
                                id="whatsapp"
                                name="whatsapp"
                                type="text"
                                value="{{ old('whatsapp') }}"
                                maxlength="30"
                                placeholder="Número de WhatsApp"
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                            >

                            @error('whatsapp')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <label
                                for="telefono"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                Teléfono
                            </label>

                            <input
                                id="telefono"
                                name="telefono"
                                type="text"
                                value="{{ old('telefono') }}"
                                maxlength="30"
                                placeholder="Número telefónico"
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                            >

                            @error('telefono')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Correo --}}
                        <div class="md:col-span-2">
                            <label
                                for="correo"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                Correo electrónico
                            </label>

                            <input
                                id="correo"
                                name="correo"
                                type="email"
                                value="{{ old('correo') }}"
                                maxlength="255"
                                placeholder="correo@ejemplo.com"
                                class="block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                            >

                            @error('correo')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Dirección --}}
                        <div class="md:col-span-2">
                            <label
                                for="direccion"
                                class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300"
                            >
                                Dirección
                            </label>

                            <textarea
                                id="direccion"
                                name="direccion"
                                rows="4"
                                maxlength="1000"
                                placeholder="Dirección del proveedor"
                                class="block w-full resize-none rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-cyan-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                            >{{ old('direccion') }}</textarea>

                            @error('direccion')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Botones --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('suppliers.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900"
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
                                d="M12 4.5v15m7.5-7.5h-15"
                            />
                        </svg>

                        Guardar proveedor
                    </button>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>