
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">
                    Crear cotización
                </h2>

                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Registra una nueva cotización para un cliente.
                </p>
            </div>

            <a
                href="{{ route('quotations.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5"/>
                    <path d="M12 19l-7-7 7-7"/>
                </svg>

                Volver
            </a>
        </div>
    </x-slot>

    <div
        x-data="quotationBuilder()"
        x-init="init()"
        class="py-6 sm:py-8"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-950/30">
                    <div class="flex gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600 dark:text-red-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 8v4"/>
                            <path d="M12 16h.01"/>
                        </svg>

                        <div>
                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Revisa los datos de la cotización.
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
                action="{{ route('quotations.store') }}"
                method="POST"
                @submit="prepareSubmit"
                class="space-y-6"
            >
                @csrf

                {{-- ========================================================= --}}
                {{-- INFORMACIÓN GENERAL                                       --}}
                {{-- ========================================================= --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="border-b border-slate-200 px-5 py-5 dark:border-slate-700 sm:px-6">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>
                                    <path d="M8 7h8"/>
                                    <path d="M8 11h8"/>
                                    <path d="M8 15h5"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white">
                                    Información de la cotización
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    Selecciona el cliente, vendedor y condiciones de la cotización.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-5 p-5 sm:p-6 lg:grid-cols-2">

                        {{-- Cliente --}}
                        <div class="lg:col-span-2">
                            <label for="customer_id" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Cliente
                            </label>

                            <select
                                id="customer_id"
                                name="customer_id"
                                x-model="customerId"
                                @change="loadCustomer"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="">Seleccionar cliente...</option>

                                @foreach ($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        data-nombre="{{ trim($customer->nombre . ' ' . $customer->apellido_paterno . ' ' . $customer->apellido_materno) }}"
                                        data-telefono="{{ $customer->telefono }}"
                                        data-whatsapp="{{ $customer->whatsapp }}"
                                        data-correo="{{ $customer->correo }}"
                                        data-pais="{{ $customer->pais }}"
                                        data-estado="{{ $customer->estado }}"
                                        data-municipio="{{ $customer->municipio }}"
                                        data-colonia="{{ $customer->colonia }}"
                                        data-calle="{{ $customer->calle }}"
                                        data-cp="{{ $customer->codigo_postal }}"
                                    >
                                        {{ trim($customer->nombre . ' ' . $customer->apellido_paterno . ' ' . $customer->apellido_materno) }}
                                        @if ($customer->empresa)
                                            — {{ $customer->empresa }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Información cliente --}}
                        <div
                            x-show="selectedCustomer"
                            x-cloak
                            x-transition
                            class="lg:col-span-2"
                        >
                            <div class="rounded-2xl border border-cyan-200 bg-cyan-50/70 p-4 dark:border-cyan-900/50 dark:bg-cyan-950/20">
                                <div class="mb-4 flex items-center gap-2">
                                    <svg class="h-5 w-5 text-cyan-600 dark:text-cyan-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M20 21a8 8 0 0 0-16 0"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>

                                    <h4 class="font-semibold text-slate-900 dark:text-white">
                                        Datos del cliente
                                    </h4>
                                </div>

                                <div class="grid gap-4 text-sm sm:grid-cols-2 lg:grid-cols-4">

                                    <div>
                                        <p class="text-slate-500 dark:text-slate-400">Nombre</p>
                                        <p class="mt-1 font-medium text-slate-900 dark:text-white" x-text="customerData.nombre || '—'"></p>
                                    </div>

                                    <div>
                                        <p class="text-slate-500 dark:text-slate-400">Teléfono</p>
                                        <p class="mt-1 font-medium text-slate-900 dark:text-white" x-text="customerData.telefono || '—'"></p>
                                    </div>

                                    <div>
                                        <p class="text-slate-500 dark:text-slate-400">WhatsApp</p>
                                        <p class="mt-1 font-medium text-slate-900 dark:text-white" x-text="customerData.whatsapp || '—'"></p>
                                    </div>

                                    <div>
                                        <p class="text-slate-500 dark:text-slate-400">Correo</p>
                                        <p class="mt-1 break-all font-medium text-slate-900 dark:text-white" x-text="customerData.correo || '—'"></p>
                                    </div>

                                    <div class="sm:col-span-2 lg:col-span-4">
                                        <p class="text-slate-500 dark:text-slate-400">Dirección</p>

                                        <p class="mt-1 font-medium text-slate-900 dark:text-white">
                                            <span x-text="customerData.calle || ''"></span>
                                            <span x-show="customerData.calle && customerData.colonia">, </span>
                                            <span x-text="customerData.colonia || ''"></span>
                                            <span x-show="customerData.municipio">, </span>
                                            <span x-text="customerData.municipio || ''"></span>
                                            <span x-show="customerData.estado">, </span>
                                            <span x-text="customerData.estado || ''"></span>
                                            <span x-show="customerData.cp">, C.P. </span>
                                            <span x-text="customerData.cp || ''"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Fecha creación --}}
                        <div>
                            <label for="fecha_creacion" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Fecha de creación
                            </label>

                            <input
                                type="date"
                                id="fecha_creacion"
                                name="fecha_creacion"
                                value="{{ old('fecha_creacion', now()->format('Y-m-d')) }}"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Fecha vencimiento --}}
                        <div>
                            <label for="fecha_vencimiento" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Fecha de vencimiento
                            </label>

                            <input
                                type="date"
                                id="fecha_vencimiento"
                                name="fecha_vencimiento"
                                value="{{ old('fecha_vencimiento') }}"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                        </div>

                        {{-- Vendedor --}}
                        <div>
                            <label for="user_id" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Vendedor
                            </label>

                            <select
                                id="user_id"
                                name="user_id"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="">Seleccionar vendedor...</option>

                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                        — {{ $user->role === 'admin' ? 'Administrador' : 'Empleado' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tipo precio --}}
                        <div>
                            <label for="tipo_precio" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Tipo de precio
                            </label>

                            <select
                                id="tipo_precio"
                                name="tipo_precio"
                                x-model="priceType"
                                @change="updateAllProductPrices"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                            >
                                <option value="publico">Público</option>
                                <option value="mayoreo">Mayoreo</option>
                                <option value="tecnicos">Técnicos</option>
                            </select>
                        </div>

                    </div>
                </section>


                {{-- ========================================================= --}}
                {{-- ITEMS                                                       --}}
                {{-- ========================================================= --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

                    <div class="flex flex-col gap-4 border-b border-slate-200 p-5 dark:border-slate-700 sm:flex-row sm:items-center sm:justify-between sm:p-6">

                        <div>
                            <h3 class="text-base font-semibold text-slate-900 dark:text-white">
                                Productos y servicios
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Agrega los conceptos que formarán parte de la cotización.
                            </p>
                        </div>

                        <button
                            type="button"
                            @click="openItemModal()"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500/40"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>

                            Agregar ítem
                        </button>
                    </div>


                    {{-- Tabla --}}
                    <div class="overflow-x-auto">

                        <table class="min-w-[900px] w-full text-left text-sm">

                            <thead class="border-b border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-950/60">
                                <tr>
                                    <th class="px-5 py-3 font-semibold text-slate-600 dark:text-slate-300">
                                        Producto / Servicio
                                    </th>

                                    <th class="px-5 py-3 font-semibold text-slate-600 dark:text-slate-300">
                                        Descripción
                                    </th>

                                    <th class="px-5 py-3 text-right font-semibold text-slate-600 dark:text-slate-300">
                                        Precio
                                    </th>

                                    <th class="px-5 py-3 text-right font-semibold text-slate-600 dark:text-slate-300">
                                        Descuento
                                    </th>

                                    <th class="px-5 py-3 text-center font-semibold text-slate-600 dark:text-slate-300">
                                        Cantidad
                                    </th>

                                    <th class="px-5 py-3 text-right font-semibold text-slate-600 dark:text-slate-300">
                                        Total
                                    </th>

                                    <th class="px-5 py-3 text-center font-semibold text-slate-600 dark:text-slate-300">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">

                                <template x-if="items.length === 0">
                                    <tr>
                                        <td colspan="7" class="px-5 py-14 text-center">

                                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">
                                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                                    <path d="M6 4h12a2 2 0 0 1 2 2v14H4V6a2 2 0 0 1 2-2Z"/>
                                                    <path d="M8 8h8"/>
                                                    <path d="M8 12h8"/>
                                                    <path d="M8 16h5"/>
                                                </svg>
                                            </div>

                                            <p class="mt-4 font-medium text-slate-700 dark:text-slate-300">
                                                Aún no hay ítems
                                            </p>

                                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                                Agrega al menos un producto o servicio.
                                            </p>
                                        </td>
                                    </tr>
                                </template>


                                <template x-for="(item, index) in items" :key="item.uid">

                                    <tr class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/40">

                                        <td class="px-5 py-4">
                                            <div class="flex items-start gap-3">

                                                <div
                                                    class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl"
                                                    :class="item.tipo === 'producto'
                                                        ? 'bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400'
                                                        : item.tipo === 'servicio'
                                                            ? 'bg-violet-50 text-violet-600 dark:bg-violet-950/40 dark:text-violet-400'
                                                            : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                                                >
                                                    <svg
                                                        x-show="item.tipo === 'producto'"
                                                        class="h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >
                                                        <path d="M6 8h12l1 12H5L6 8Z"/>
                                                        <path d="M9 8a3 3 0 0 1 6 0"/>
                                                    </svg>

                                                    <svg
                                                        x-show="item.tipo === 'servicio'"
                                                        class="h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >
                                                        <path d="M12 3v4"/>
                                                        <path d="M12 17v4"/>
                                                        <path d="M3 12h4"/>
                                                        <path d="M17 12h4"/>
                                                        <path d="M5.6 5.6l2.8 2.8"/>
                                                        <path d="M15.6 15.6l2.8 2.8"/>
                                                        <path d="M18.4 5.6l-2.8 2.8"/>
                                                        <path d="M8.4 15.6l-2.8 2.8"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>

                                                    <svg
                                                        x-show="item.tipo === 'manual'"
                                                        class="h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >
                                                        <path d="M4 20h4L19 9l-4-4L4 16v4Z"/>
                                                        <path d="m13.5 6.5 4 4"/>
                                                    </svg>
                                                </div>

                                                <div class="min-w-0">
                                                    <p
                                                        class="font-semibold text-slate-900 dark:text-white"
                                                        x-text="item.nombre"
                                                    ></p>

                                                    <p
                                                        class="mt-0.5 text-xs uppercase tracking-wide text-slate-400 dark:text-slate-500"
                                                        x-text="item.tipo"
                                                    ></p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="max-w-[260px] px-5 py-4">
                                            <p
                                                class="truncate text-slate-600 dark:text-slate-300"
                                                :title="item.descripcion"
                                                x-text="item.descripcion || 'Sin descripción'"
                                            ></p>
                                        </td>

                                        <td class="px-5 py-4 text-right font-medium text-slate-700 dark:text-slate-200">
                                            $<span x-text="money(item.precio_unitario)"></span>
                                        </td>

                                        <td class="px-5 py-4 text-right">
                                            <span
                                                class="font-medium"
                                                :class="item.descuento > 0
                                                    ? 'text-red-600 dark:text-red-400'
                                                    : 'text-slate-500 dark:text-slate-400'"
                                            >
                                                -$<span x-text="money(item.descuento)"></span>
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 text-center font-medium text-slate-700 dark:text-slate-200">
                                            <span x-text="formatQuantity(item.cantidad)"></span>
                                        </td>

                                        <td class="px-5 py-4 text-right font-bold text-slate-900 dark:text-white">
                                            $<span x-text="money(item.total)"></span>
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-center gap-2">

                                                <button
                                                    type="button"
                                                    @click="editItem(index)"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:border-cyan-300 hover:bg-cyan-50 hover:text-cyan-600 dark:border-slate-700 dark:text-slate-300 dark:hover:border-cyan-800 dark:hover:bg-cyan-950/30 dark:hover:text-cyan-400"
                                                    title="Editar"
                                                >
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                        <path d="M4 20h4L19 9l-4-4L4 16v4Z"/>
                                                        <path d="m13.5 6.5 4 4"/>
                                                    </svg>
                                                </button>

                                                <button
                                                    type="button"
                                                    @click="removeItem(index)"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:border-red-300 hover:bg-red-50 hover:text-red-600 dark:border-slate-700 dark:text-slate-300 dark:hover:border-red-900 dark:hover:bg-red-950/30 dark:hover:text-red-400"
                                                    title="Eliminar"
                                                >
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                        <path d="M4 7h16"/>
                                                        <path d="M10 11v6"/>
                                                        <path d="M14 11v6"/>
                                                        <path d="M6 7l1 14h10l1-14"/>
                                                        <path d="M9 7V4h6v3"/>
                                                    </svg>
                                                </button>

                                            </div>
                                        </td>

                                    </tr>

                                </template>

                            </tbody>

                        </table>
                    </div>


                    {{-- Resumen --}}
                    <div class="border-t border-slate-200 bg-slate-50/70 dark:border-slate-700 dark:bg-slate-950/40">

                        <div class="ml-auto w-full max-w-md space-y-3 p-5 sm:p-6">

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500 dark:text-slate-400">
                                    Subtotal
                                </span>

                                <span class="font-semibold text-slate-800 dark:text-slate-200">
                                    $<span x-text="money(subtotal)"></span>
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500 dark:text-slate-400">
                                    Descuento
                                </span>

                                <span class="font-semibold text-red-600 dark:text-red-400">
                                    -$<span x-text="money(discountTotal)"></span>
                                </span>
                            </div>

                            <div class="border-t border-slate-200 pt-3 dark:border-slate-700">
                                <div class="flex items-center justify-between">
                                    <span class="text-base font-semibold text-slate-900 dark:text-white">
                                        Total
                                    </span>

                                    <span class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">
                                        $<span x-text="money(grandTotal)"></span>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>

                </section>


                {{-- ========================================================= --}}
                {{-- NOTAS                                                       --}}
                {{-- ========================================================= --}}

                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-6">

                    <label for="notas" class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                        Notas
                    </label>

                    <textarea
                        id="notas"
                        name="notas"
                        rows="4"
                        placeholder="Agrega observaciones o condiciones de la cotización..."
                        class="w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-500"
                    >{{ old('notas') }}</textarea>

                </section>


                {{-- ========================================================= --}}
                {{-- BOTONES                                                      --}}
                {{-- ========================================================= --}}

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('quotations.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        :disabled="items.length === 0 || submitting"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        <svg
                            x-show="!submitting"
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M5 12.5 9.5 17 19 7.5"/>
                        </svg>

                        <svg
                            x-show="submitting"
                            class="h-4 w-4 animate-spin"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle cx="12" cy="12" r="9" class="opacity-25"/>
                            <path d="M21 12a9 9 0 0 1-9 9"/>
                        </svg>

                        <span x-text="submitting ? 'Guardando...' : 'Crear cotización'"></span>
                    </button>

                </div>


                {{-- Hidden items --}}
                <div id="quotation-hidden-items"></div>

            </form>
        </div>


        {{-- ============================================================= --}}
        {{-- MODAL AGREGAR / EDITAR ÍTEM                                   --}}
        {{-- ============================================================= --}}

        <div
            x-show="itemModalOpen"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5"
            @keydown.escape.window="closeItemModal()"
        >

            <div
                class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
                @click="closeItemModal()"
            ></div>


            <div
                x-show="itemModalOpen"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="translate-y-4 opacity-0 scale-[0.98]"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                class="relative flex max-h-[94vh] w-full max-w-6xl flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-700 dark:bg-slate-900"
            >

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4 dark:border-slate-700 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-semibold text-slate-900 dark:text-white" x-text="editingIndex !== null ? 'Editar ítem' : 'Agregar ítem'"></h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                Busca, crea o selecciona un producto o servicio.
                            </p>
                        </div>

                    </div>

                    <button
                        type="button"
                        @click="closeItemModal()"
                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 6l12 12"/>
                            <path d="M18 6 6 18"/>
                        </svg>
                    </button>

                </div>


                {{-- Tabs --}}
                <div class="overflow-x-auto border-b border-slate-200 dark:border-slate-700">

                    <div class="flex min-w-max px-4 sm:px-6">

                        <button
                            type="button"
                            @click="modalTab = 'buscar'"
                            :class="modalTab === 'buscar'
                                ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400'
                                : 'border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200'"
                            class="inline-flex items-center gap-2 border-b-2 px-4 py-3 text-sm font-semibold transition"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m20 20-4-4"/>
                            </svg>

                            Buscar producto
                        </button>

                        <button
                            type="button"
                            @click="modalTab = 'agregar'"
                            :class="modalTab === 'agregar'
                                ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400'
                                : 'border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200'"
                            class="inline-flex items-center gap-2 border-b-2 px-4 py-3 text-sm font-semibold transition"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>

                            Agregar producto
                        </button>

                        <button
                            type="button"
                            @click="modalTab = 'servicios'"
                            :class="modalTab === 'servicios'
                                ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400'
                                : 'border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200'"
                            class="inline-flex items-center gap-2 border-b-2 px-4 py-3 text-sm font-semibold transition"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 3v4"/>
                                <path d="M12 17v4"/>
                                <path d="M3 12h4"/>
                                <path d="M17 12h4"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            Servicios
                        </button>

                        <button
                            type="button"
                            @click="modalTab = 'catalogos'"
                            :class="modalTab === 'catalogos'
                                ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400'
                                : 'border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200'"
                            class="inline-flex items-center gap-2 border-b-2 px-4 py-3 text-sm font-semibold transition"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M4 6h16"/>
                                <path d="M4 12h16"/>
                                <path d="M4 18h16"/>
                                <circle cx="8" cy="6" r="1"/>
                                <circle cx="8" cy="12" r="1"/>
                                <circle cx="8" cy="18" r="1"/>
                            </svg>

                            Catálogos
                        </button>

                    </div>
                </div>


                {{-- Modal body --}}
                <div class="min-h-0 flex-1 overflow-y-auto p-5 sm:p-6">


                    {{-- ================================================= --}}
                    {{-- BUSCAR PRODUCTO                                   --}}
                    {{-- ================================================= --}}

                    <div x-show="modalTab === 'buscar'" x-cloak>

                        <div class="mb-5">
                            <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Buscar producto
                            </label>

                            <div class="relative">

                                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="11" cy="11" r="7"/>
                                    <path d="m20 20-4-4"/>
                                </svg>

                                <input
                                    type="search"
                                    x-model="productSearch"
                                    placeholder="Buscar por nombre, código, categoría o marca..."
                                    class="w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:placeholder:text-slate-500"
                                >

                            </div>
                        </div>


                        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">

                            <template x-for="product in filteredProducts" :key="product.id">

                                <button
                                    type="button"
                                    @click="selectProduct(product)"
                                    class="group rounded-2xl border border-slate-200 bg-white p-4 text-left transition hover:-translate-y-0.5 hover:border-cyan-300 hover:shadow-md dark:border-slate-700 dark:bg-slate-950 dark:hover:border-cyan-800"
                                >

                                    <div class="flex items-start justify-between gap-3">

                                        <div class="flex min-w-0 items-center gap-3">

                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path d="M6 8h12l1 12H5L6 8Z"/>
                                                    <path d="M9 8a3 3 0 0 1 6 0"/>
                                                </svg>
                                            </div>

                                            <div class="min-w-0">
                                                <p class="truncate font-semibold text-slate-900 dark:text-white" x-text="product.nombre"></p>
                                                <p class="mt-0.5 truncate text-xs text-slate-500 dark:text-slate-400" x-text="product.codigo"></p>
                                            </div>

                                        </div>

                                        <svg class="h-4 w-4 shrink-0 text-slate-300 transition group-hover:text-cyan-500 dark:text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="m9 18 6-6-6-6"/>
                                        </svg>

                                    </div>

                                    <div class="mt-4 flex items-end justify-between gap-3">

                                        <div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                Precio <span x-text="priceTypeLabel"></span>
                                            </p>

                                            <p class="mt-1 text-lg font-bold text-cyan-600 dark:text-cyan-400">
                                                $<span x-text="money(productPrice(product))"></span>
                                            </p>
                                        </div>

                                        <span class="rounded-lg bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                            Seleccionar
                                        </span>

                                    </div>

                                </button>

                            </template>

                        </div>


                        <div
                            x-show="filteredProducts.length === 0"
                            class="rounded-2xl border border-dashed border-slate-300 py-12 text-center dark:border-slate-700"
                        >
                            <svg class="mx-auto h-8 w-8 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m20 20-4-4"/>
                            </svg>

                            <p class="mt-3 font-medium text-slate-700 dark:text-slate-300">
                                No encontramos productos
                            </p>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Puedes crear uno desde "Agregar producto".
                            </p>
                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- AGREGAR PRODUCTO                                  --}}
                    {{-- ================================================= --}}

                    <div x-show="modalTab === 'agregar'" x-cloak>

                        <div class="mb-5 rounded-2xl border border-cyan-200 bg-cyan-50/70 p-4 dark:border-cyan-900/50 dark:bg-cyan-950/20">
                            <div class="flex gap-3">

                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-cyan-600 dark:text-cyan-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 8v8"/>
                                    <path d="M8 12h8"/>
                                </svg>

                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">
                                        Crear producto
                                    </p>

                                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                                        El producto se guardará en el catálogo y podrá utilizarse en futuras cotizaciones.
                                    </p>
                                </div>

                            </div>
                        </div>


                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Código
                                </label>

                                <input
                                    type="text"
                                    x-model="newProduct.codigo"
                                    placeholder="Ej. PROD-001"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Nombre
                                </label>

                                <input
                                    type="text"
                                    x-model="newProduct.nombre"
                                    placeholder="Nombre del producto"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Categoría
                                </label>

                                <input
                                    type="text"
                                    x-model="newProduct.categoria"
                                    placeholder="Ej. Pantallas"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Marca
                                </label>

                                <input
                                    type="text"
                                    x-model="newProduct.marca"
                                    placeholder="Ej. Samsung"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Precio público
                                </label>

                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">$</span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model="newProduct.precio_publico"
                                        class="w-full rounded-xl border border-slate-300 bg-white py-3 pl-8 pr-4 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Precio mayoreo
                                </label>

                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">$</span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model="newProduct.precio_mayoreo"
                                        class="w-full rounded-xl border border-slate-300 bg-white py-3 pl-8 pr-4 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Precio técnicos
                                </label>

                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">$</span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model="newProduct.precio_tecnicos"
                                        class="w-full rounded-xl border border-slate-300 bg-white py-3 pl-8 pr-4 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    >
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Descripción
                                </label>

                                <textarea
                                    rows="3"
                                    x-model="newProduct.descripcion"
                                    placeholder="Descripción del producto..."
                                    class="w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                ></textarea>
                            </div>

                        </div>


                        <div class="mt-6 flex justify-end">

                            <button
                                type="button"
                                @click="createProduct()"
                                :disabled="creatingProduct"
                                class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700 disabled:opacity-50"
                            >
                                <svg
                                    x-show="!creatingProduct"
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>

                                <svg
                                    x-show="creatingProduct"
                                    class="h-4 w-4 animate-spin"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <circle cx="12" cy="12" r="9" class="opacity-25"/>
                                    <path d="M21 12a9 9 0 0 1-9 9"/>
                                </svg>

                                <span x-text="creatingProduct ? 'Guardando...' : 'Crear producto'"></span>
                            </button>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SERVICIOS                                         --}}
                    {{-- ================================================= --}}

                    <div x-show="modalTab === 'servicios'" x-cloak>

                        <div class="grid gap-6 lg:grid-cols-[1fr_360px]">

                            {{-- Lista --}}
                            <div>

                                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                    <div>
                                        <h4 class="font-semibold text-slate-900 dark:text-white">
                                            Servicios disponibles
                                        </h4>

                                        <p class="text-sm text-slate-500 dark:text-slate-400">
                                            Selecciona uno para agregarlo a la cotización.
                                        </p>
                                    </div>

                                    <div class="relative sm:w-64">

                                        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <circle cx="11" cy="11" r="7"/>
                                            <path d="m20 20-4-4"/>
                                        </svg>

                                        <input
                                            type="search"
                                            x-model="serviceSearch"
                                            placeholder="Buscar servicio..."
                                            class="w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-9 pr-3 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                        >

                                    </div>

                                </div>


                                <div class="space-y-3">

                                    <template x-for="service in filteredServices" :key="service.id">

                                        <button
                                            type="button"
                                            @click="selectService(service)"
                                            class="flex w-full items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-4 text-left transition hover:border-violet-300 hover:shadow-sm dark:border-slate-700 dark:bg-slate-950 dark:hover:border-violet-800"
                                        >

                                            <div class="flex min-w-0 items-center gap-3">

                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-950/40 dark:text-violet-400">
                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                        <path d="M12 3v4"/>
                                                        <path d="M12 17v4"/>
                                                        <path d="M3 12h4"/>
                                                        <path d="M17 12h4"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>
                                                </div>

                                                <div class="min-w-0">
                                                    <p class="truncate font-semibold text-slate-900 dark:text-white" x-text="service.nombre"></p>

                                                    <p class="mt-1 truncate text-xs text-slate-500 dark:text-slate-400">
                                                        <span x-text="service.codigo"></span>
                                                        <span x-show="service.categoria"> · </span>
                                                        <span x-text="service.categoria"></span>
                                                    </p>
                                                </div>

                                            </div>

                                            <div class="shrink-0 text-right">
                                                <p class="font-bold text-violet-600 dark:text-violet-400">
                                                    $<span x-text="money(service.precio)"></span>
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    Seleccionar
                                                </p>
                                            </div>

                                        </button>

                                    </template>

                                </div>

                            </div>


                            {{-- Crear servicio --}}
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-950/60">

                                <div class="mb-5">
                                    <h4 class="font-semibold text-slate-900 dark:text-white">
                                        Crear servicio
                                    </h4>

                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Se guardará en el catálogo.
                                    </p>
                                </div>

                                <div class="space-y-4">

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">
                                            Código
                                        </label>

                                        <input
                                            type="text"
                                            x-model="newService.codigo"
                                            placeholder="SER-001"
                                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">
                                            Nombre
                                        </label>

                                        <input
                                            type="text"
                                            x-model="newService.nombre"
                                            placeholder="Ej. Cambio de pantalla"
                                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">
                                            Categoría
                                        </label>

                                        <input
                                            type="text"
                                            x-model="newService.categoria"
                                            placeholder="Ej. Reparación"
                                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">
                                            Precio
                                        </label>

                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400">$</span>

                                            <input
                                                type="number"
                                                step="0.01"
                                                min="0"
                                                x-model="newService.precio"
                                                class="w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-7 pr-3 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                            >
                                        </div>
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">
                                            Descripción
                                        </label>

                                        <textarea
                                            rows="3"
                                            x-model="newService.descripcion"
                                            placeholder="Descripción..."
                                            class="w-full resize-y rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                        ></textarea>
                                    </div>

                                    <button
                                        type="button"
                                        @click="createService()"
                                        :disabled="creatingService"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-violet-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-violet-700 disabled:opacity-50"
                                    >
                                        <svg
                                            x-show="!creatingService"
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="M12 5v14"/>
                                            <path d="M5 12h14"/>
                                        </svg>

                                        <svg
                                            x-show="creatingService"
                                            class="h-4 w-4 animate-spin"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <circle cx="12" cy="12" r="9" class="opacity-25"/>
                                            <path d="M21 12a9 9 0 0 1-9 9"/>
                                        </svg>

                                        <span x-text="creatingService ? 'Guardando...' : 'Crear servicio'"></span>
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- CATÁLOGOS                                         --}}
                    {{-- ================================================= --}}

                    <div x-show="modalTab === 'catalogos'" x-cloak>

                        <div class="mb-5 flex flex-wrap gap-2">

                            <button
                                type="button"
                                @click="catalogTab = 'productos'"
                                :class="catalogTab === 'productos'
                                    ? 'bg-cyan-600 text-white'
                                    : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                                class="rounded-xl px-4 py-2.5 text-sm font-semibold transition"
                            >
                                Productos
                            </button>

                            <button
                                type="button"
                                @click="catalogTab = 'servicios'"
                                :class="catalogTab === 'servicios'
                                    ? 'bg-violet-600 text-white'
                                    : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                                class="rounded-xl px-4 py-2.5 text-sm font-semibold transition"
                            >
                                Servicios
                            </button>

                        </div>


                        {{-- Catálogo productos --}}
                        <div x-show="catalogTab === 'productos'">

                            <div class="mb-4">
                                <input
                                    type="search"
                                    x-model="catalogProductSearch"
                                    placeholder="Buscar producto en el catálogo..."
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">

                                <template x-for="product in catalogProducts" :key="product.id">

                                    <button
                                        type="button"
                                        @click="selectProduct(product)"
                                        class="rounded-2xl border border-slate-200 bg-white p-4 text-left transition hover:border-cyan-300 hover:shadow-sm dark:border-slate-700 dark:bg-slate-950 dark:hover:border-cyan-800"
                                    >

                                        <div class="flex items-start gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path d="M6 8h12l1 12H5L6 8Z"/>
                                                    <path d="M9 8a3 3 0 0 1 6 0"/>
                                                </svg>
                                            </div>

                                            <div class="min-w-0 flex-1">
                                                <p class="truncate font-semibold text-slate-900 dark:text-white" x-text="product.nombre"></p>

                                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400" x-text="product.codigo"></p>

                                                <p class="mt-2 font-bold text-cyan-600 dark:text-cyan-400">
                                                    $<span x-text="money(productPrice(product))"></span>
                                                </p>
                                            </div>

                                        </div>

                                    </button>

                                </template>

                            </div>

                        </div>


                        {{-- Catálogo servicios --}}
                        <div x-show="catalogTab === 'servicios'">

                            <div class="mb-4">
                                <input
                                    type="search"
                                    x-model="catalogServiceSearch"
                                    placeholder="Buscar servicio en el catálogo..."
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >
                            </div>

                            <div class="space-y-3">

                                <template x-for="service in catalogServices" :key="service.id">

                                    <button
                                        type="button"
                                        @click="selectService(service)"
                                        class="flex w-full items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-4 text-left transition hover:border-violet-300 hover:shadow-sm dark:border-slate-700 dark:bg-slate-950 dark:hover:border-violet-800"
                                    >

                                        <div class="flex min-w-0 items-center gap-3">

                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-950/40 dark:text-violet-400">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path d="M12 3v4"/>
                                                    <path d="M12 17v4"/>
                                                    <path d="M3 12h4"/>
                                                    <path d="M17 12h4"/>
                                                    <circle cx="12" cy="12" r="3"/>
                                                </svg>
                                            </div>

                                            <div class="min-w-0">
                                                <p class="truncate font-semibold text-slate-900 dark:text-white" x-text="service.nombre"></p>

                                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                                    <span x-text="service.codigo"></span>
                                                    <span x-show="service.categoria"> · </span>
                                                    <span x-text="service.categoria"></span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="shrink-0 font-bold text-violet-600 dark:text-violet-400">
                                            $<span x-text="money(service.precio)"></span>
                                        </div>

                                    </button>

                                </template>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- CONFIGURACIÓN DEL ÍTEM                             --}}
                    {{-- ================================================= --}}

                    <div
                        x-show="itemFormVisible"
                        x-cloak
                        class="mt-8 border-t border-slate-200 pt-6 dark:border-slate-700"
                    >

                        <div class="mb-5 flex items-center justify-between gap-3">

                            <div>
                                <h4 class="font-semibold text-slate-900 dark:text-white">
                                    Configurar ítem
                                </h4>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    Ajusta precio, cantidad, descuento y descripción.
                                </p>
                            </div>

                            <button
                                type="button"
                                @click="clearItemForm()"
                                class="text-sm font-medium text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white"
                            >
                                Limpiar
                            </button>

                        </div>


                        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                            <div class="sm:col-span-2 lg:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Producto / Servicio
                                </label>

                                <input
                                    type="text"
                                    x-model="itemForm.nombre"
                                    class="w-full rounded-xl border border-slate-300 bg-slate-100 px-4 py-3 text-sm font-medium text-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                                    readonly
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Precio
                                </label>

                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">$</span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model.number="itemForm.precio_unitario"
                                        @input="calculateItemForm"
                                        class="w-full rounded-xl border border-slate-300 bg-white py-3 pl-8 pr-4 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Cantidad
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0.01"
                                    x-model.number="itemForm.cantidad"
                                    @input="calculateItemForm"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Descuento
                                </label>

                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">$</span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        x-model.number="itemForm.descuento"
                                        @input="calculateItemForm"
                                        class="w-full rounded-xl border border-slate-300 bg-white py-3 pl-8 pr-4 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Total
                                </label>

                                <div class="rounded-xl border border-cyan-200 bg-cyan-50 px-4 py-3 text-sm font-bold text-cyan-700 dark:border-cyan-900/50 dark:bg-cyan-950/20 dark:text-cyan-400">
                                    $<span x-text="money(itemForm.total)"></span>
                                </div>
                            </div>

                            <div class="sm:col-span-2 lg:col-span-4">
                                <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Descripción
                                </label>

                                <textarea
                                    rows="3"
                                    x-model="itemForm.descripcion"
                                    placeholder="Descripción específica para este ítem..."
                                    class="w-full resize-y rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                ></textarea>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Modal footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-950/50 sm:flex-row sm:items-center sm:justify-end sm:p-5">

                    <button
                        type="button"
                        @click="closeItemModal()"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Cancelar
                    </button>

                    <button
                        type="button"
                        @click="saveItem()"
                        :disabled="!itemFormVisible"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-700 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12.5 9.5 17 19 7.5"/>
                        </svg>

                        <span x-text="editingIndex !== null ? 'Guardar cambios' : 'Agregar a cotización'"></span>
                    </button>

                </div>

            </div>
        </div>

    </div>


    {{-- ================================================================ --}}
    {{-- ALPINE                                                           --}}
    {{-- ================================================================ --}}

    <script>
        function quotationBuilder() {
            return {
                itemModalOpen: false,
                modalTab: 'buscar',
                catalogTab: 'productos',

                customerId: '',
                selectedCustomer: false,

                customerData: {
                    nombre: '',
                    telefono: '',
                    whatsapp: '',
                    correo: '',
                    pais: '',
                    estado: '',
                    municipio: '',
                    colonia: '',
                    calle: '',
                    cp: '',
                },

                priceType: 'publico',

                products: @json($products->values()),
                services: @json($services->values()),

                productSearch: '',
                serviceSearch: '',
                catalogProductSearch: '',
                catalogServiceSearch: '',

                items: [],

                editingIndex: null,

                itemFormVisible: false,

                itemForm: {
                    tipo: 'producto',
                    product_id: null,
                    service_id: null,
                    nombre: '',
                    descripcion: '',
                    cantidad: 1,
                    precio_unitario: 0,
                    descuento: 0,
                    total: 0,
                },

                newProduct: {
                    codigo: '',
                    nombre: '',
                    categoria: '',
                    marca: '',
                    descripcion: '',
                    precio_publico: 0,
                    precio_mayoreo: 0,
                    precio_tecnicos: 0,
                },

                newService: {
                    codigo: '',
                    nombre: '',
                    categoria: '',
                    descripcion: '',
                    precio: 0,
                },

                creatingProduct: false,
                creatingService: false,
                submitting: false,

                init() {
                    this.$watch('itemForm.cantidad', () => this.calculateItemForm());
                    this.$watch('itemForm.precio_unitario', () => this.calculateItemForm());
                    this.$watch('itemForm.descuento', () => this.calculateItemForm());
                },

                get filteredProducts() {
                    const search = this.productSearch.toLowerCase().trim();

                    if (!search) {
                        return this.products;
                    }

                    return this.products.filter(product => {
                        return [
                            product.nombre,
                            product.codigo,
                            product.categoria,
                            product.marca,
                        ]
                        .filter(Boolean)
                        .join(' ')
                        .toLowerCase()
                        .includes(search);
                    });
                },

                get filteredServices() {
                    const search = this.serviceSearch.toLowerCase().trim();

                    if (!search) {
                        return this.services;
                    }

                    return this.services.filter(service => {
                        return [
                            service.nombre,
                            service.codigo,
                            service.categoria,
                            service.descripcion,
                        ]
                        .filter(Boolean)
                        .join(' ')
                        .toLowerCase()
                        .includes(search);
                    });
                },

                get catalogProducts() {
                    const search = this.catalogProductSearch.toLowerCase().trim();

                    if (!search) {
                        return this.products;
                    }

                    return this.products.filter(product => {
                        return [
                            product.nombre,
                            product.codigo,
                            product.categoria,
                            product.marca,
                        ]
                        .filter(Boolean)
                        .join(' ')
                        .toLowerCase()
                        .includes(search);
                    });
                },

                get catalogServices() {
                    const search = this.catalogServiceSearch.toLowerCase().trim();

                    if (!search) {
                        return this.services;
                    }

                    return this.services.filter(service => {
                        return [
                            service.nombre,
                            service.codigo,
                            service.categoria,
                            service.descripcion,
                        ]
                        .filter(Boolean)
                        .join(' ')
                        .toLowerCase()
                        .includes(search);
                    });
                },

                get priceTypeLabel() {
                    return {
                        publico: 'público',
                        mayoreo: 'mayoreo',
                        tecnicos: 'técnicos',
                    }[this.priceType] ?? 'público';
                },

                get subtotal() {
                    return this.items.reduce((sum, item) => {
                        return sum + (
                            Number(item.cantidad || 0) *
                            Number(item.precio_unitario || 0)
                        );
                    }, 0);
                },

                get discountTotal() {
                    return this.items.reduce((sum, item) => {
                        return sum + Number(item.descuento || 0);
                    }, 0);
                },

                get grandTotal() {
                    return this.items.reduce((sum, item) => {
                        return sum + Number(item.total || 0);
                    }, 0);
                },

                loadCustomer() {
                    const select = document.getElementById('customer_id');

                    if (!select || !select.value) {
                        this.selectedCustomer = false;

                        this.customerData = {
                            nombre: '',
                            telefono: '',
                            whatsapp: '',
                            correo: '',
                            pais: '',
                            estado: '',
                            municipio: '',
                            colonia: '',
                            calle: '',
                            cp: '',
                        };

                        return;
                    }

                    const option = select.options[select.selectedIndex];

                    this.customerData = {
                        nombre: option.dataset.nombre || '',
                        telefono: option.dataset.telefono || '',
                        whatsapp: option.dataset.whatsapp || '',
                        correo: option.dataset.correo || '',
                        pais: option.dataset.pais || '',
                        estado: option.dataset.estado || '',
                        municipio: option.dataset.municipio || '',
                        colonia: option.dataset.colonia || '',
                        calle: option.dataset.calle || '',
                        cp: option.dataset.cp || '',
                    };

                    this.selectedCustomer = true;
                },

                openItemModal() {
                    this.editingIndex = null;
                    this.modalTab = 'buscar';
                    this.clearItemForm();

                    this.itemModalOpen = true;
                },

                closeItemModal() {
                    this.itemModalOpen = false;
                    this.editingIndex = null;
                    this.clearItemForm();
                },

                clearItemForm() {
                    this.itemFormVisible = false;

                    this.itemForm = {
                        tipo: 'producto',
                        product_id: null,
                        service_id: null,
                        nombre: '',
                        descripcion: '',
                        cantidad: 1,
                        precio_unitario: 0,
                        descuento: 0,
                        total: 0,
                    };
                },

                selectProduct(product) {
                    this.itemForm = {
                        tipo: 'producto',
                        product_id: product.id,
                        service_id: null,
                        nombre: product.nombre || '',
                        descripcion: product.descripcion || '',
                        cantidad: 1,
                        precio_unitario: this.productPrice(product),
                        descuento: 0,
                        total: this.productPrice(product),
                    };

                    this.itemFormVisible = true;

                    this.modalTab = 'buscar';
                },

                selectService(service) {
                    this.itemForm = {
                        tipo: 'servicio',
                        product_id: null,
                        service_id: service.id,
                        nombre: service.nombre || '',
                        descripcion: service.descripcion || '',
                        cantidad: 1,
                        precio_unitario: Number(service.precio || 0),
                        descuento: 0,
                        total: Number(service.precio || 0),
                    };

                    this.itemFormVisible = true;
                },

                productPrice(product) {
                    if (!product) {
                        return 0;
                    }

                    if (this.priceType === 'mayoreo') {
                        return Number(product.precio_mayoreo || 0);
                    }

                    if (this.priceType === 'tecnicos') {
                        return Number(product.precio_tecnicos || 0);
                    }

                    return Number(product.precio_publico || 0);
                },

                updateAllProductPrices() {
                    this.items = this.items.map(item => {

                        if (item.tipo !== 'producto' || !item.product_id) {
                            return item;
                        }

                        const product = this.products.find(
                            product => Number(product.id) === Number(item.product_id)
                        );

                        if (!product) {
                            return item;
                        }

                        item.precio_unitario = this.productPrice(product);
                        item.total = Math.max(
                            0,
                            (Number(item.cantidad) * Number(item.precio_unitario)) -
                            Number(item.descuento)
                        );

                        return item;
                    });

                    if (
                        this.itemForm.tipo === 'producto' &&
                        this.itemForm.product_id
                    ) {
                        const product = this.products.find(
                            product => Number(product.id) === Number(this.itemForm.product_id)
                        );

                        if (product) {
                            this.itemForm.precio_unitario = this.productPrice(product);
                            this.calculateItemForm();
                        }
                    }
                },

                calculateItemForm() {
                    const cantidad = Number(this.itemForm.cantidad || 0);
                    const precio = Number(this.itemForm.precio_unitario || 0);
                    const descuento = Number(this.itemForm.descuento || 0);

                    const importe = cantidad * precio;

                    this.itemForm.total = Math.max(
                        0,
                        importe - Math.min(descuento, importe)
                    );
                },

                saveItem() {
                    if (!this.itemFormVisible) {
                        return;
                    }

                    const nombre = String(this.itemForm.nombre || '').trim();

                    if (!nombre) {
                        alert('Selecciona o crea un producto o servicio.');
                        return;
                    }

                    const cantidad = Number(this.itemForm.cantidad || 0);

                    if (cantidad <= 0) {
                        alert('La cantidad debe ser mayor a cero.');
                        return;
                    }

                    const precio = Number(this.itemForm.precio_unitario || 0);
                    const descuento = Math.max(
                        0,
                        Number(this.itemForm.descuento || 0)
                    );

                    const importe = cantidad * precio;

                    const item = {
                        ...this.itemForm,
                        uid: this.editingIndex !== null
                            ? this.items[this.editingIndex].uid
                            : Date.now() + Math.random(),

                        nombre,
                        cantidad,
                        precio_unitario: precio,
                        descuento: Math.min(descuento, importe),
                        total: Math.max(
                            0,
                            importe - Math.min(descuento, importe)
                        ),
                    };

                    if (this.editingIndex !== null) {
                        this.items[this.editingIndex] = item;
                    } else {
                        this.items.push(item);
                    }

                    this.closeItemModal();
                },

                editItem(index) {
                    const item = this.items[index];

                    this.editingIndex = index;

                    this.itemForm = {
                        tipo: item.tipo,
                        product_id: item.product_id,
                        service_id: item.service_id,
                        nombre: item.nombre,
                        descripcion: item.descripcion || '',
                        cantidad: Number(item.cantidad),
                        precio_unitario: Number(item.precio_unitario),
                        descuento: Number(item.descuento),
                        total: Number(item.total),
                    };

                    this.itemFormVisible = true;

                    this.modalTab = item.tipo === 'servicio'
                        ? 'servicios'
                        : 'buscar';

                    this.itemModalOpen = true;

                    this.calculateItemForm();
                },

                removeItem(index) {
                    if (!confirm('¿Deseas eliminar este ítem de la cotización?')) {
                        return;
                    }

                    this.items.splice(index, 1);
                },

                async createProduct() {
                    if (
                        !this.newProduct.codigo ||
                        !this.newProduct.nombre
                    ) {
                        alert('El código y el nombre son obligatorios.');
                        return;
                    }

                    this.creatingProduct = true;

                    try {
                        const response = await fetch(
                            '{{ route('quotations.products.store') }}',
                            {
                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document
                                        .querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },

                                body: JSON.stringify(this.newProduct),
                            }
                        );

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(
                                this.validationMessage(data)
                            );
                        }

                        const product = data.product;

                        this.products.push(product);

                        this.newProduct = {
                            codigo: '',
                            nombre: '',
                            categoria: '',
                            marca: '',
                            descripcion: '',
                            precio_publico: 0,
                            precio_mayoreo: 0,
                            precio_tecnicos: 0,
                        };

                        this.selectProduct(product);

                        alert('Producto creado correctamente.');

                    } catch (error) {
                        alert(error.message || 'No fue posible crear el producto.');
                    } finally {
                        this.creatingProduct = false;
                    }
                },

                async createService() {
                    if (
                        !this.newService.codigo ||
                        !this.newService.nombre
                    ) {
                        alert('El código y el nombre son obligatorios.');
                        return;
                    }

                    this.creatingService = true;

                    try {
                        const response = await fetch(
                            '{{ route('quotations.services.store') }}',
                            {
                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document
                                        .querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },

                                body: JSON.stringify(this.newService),
                            }
                        );

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(
                                this.validationMessage(data)
                            );
                        }

                        const service = data.service;

                        this.services.push(service);

                        this.newService = {
                            codigo: '',
                            nombre: '',
                            categoria: '',
                            descripcion: '',
                            precio: 0,
                        };

                        this.selectService(service);

                        alert('Servicio creado correctamente.');

                    } catch (error) {
                        alert(error.message || 'No fue posible crear el servicio.');
                    } finally {
                        this.creatingService = false;
                    }
                },

                validationMessage(data) {
                    if (data?.errors) {
                        return Object
                            .values(data.errors)
                            .flat()
                            .join('\n');
                    }

                    return data?.message || 'Ocurrió un error.';
                },

                prepareSubmit(event) {
                    if (this.submitting) {
                        event.preventDefault();
                        return;
                    }

                    if (!this.customerId) {
                        event.preventDefault();

                        alert('Selecciona un cliente.');
                        return;
                    }

                    if (this.items.length === 0) {
                        event.preventDefault();

                        alert('Agrega al menos un ítem a la cotización.');
                        return;
                    }

                    this.submitting = true;

                    const container = document.getElementById(
                        'quotation-hidden-items'
                    );

                    container.innerHTML = '';

                    this.items.forEach((item, index) => {

                        this.addHidden(
                            container,
                            `items[${index}][tipo]`,
                            item.tipo
                        );

                        this.addHidden(
                            container,
                            `items[${index}][product_id]`,
                            item.product_id ?? ''
                        );

                        this.addHidden(
                            container,
                            `items[${index}][service_id]`,
                            item.service_id ?? ''
                        );

                        this.addHidden(
                            container,
                            `items[${index}][nombre]`,
                            item.nombre
                        );

                        this.addHidden(
                            container,
                            `items[${index}][descripcion]`,
                            item.descripcion ?? ''
                        );

                        this.addHidden(
                            container,
                            `items[${index}][cantidad]`,
                            item.cantidad
                        );

                        this.addHidden(
                            container,
                            `items[${index}][precio_unitario]`,
                            item.precio_unitario
                        );

                        this.addHidden(
                            container,
                            `items[${index}][descuento]`,
                            item.descuento
                        );
                    });
                },

                addHidden(container, name, value) {
                    const input = document.createElement('input');

                    input.type = 'hidden';
                    input.name = name;
                    input.value = value;

                    container.appendChild(input);
                },

                formatQuantity(value) {
                    const number = Number(value || 0);

                    return Number.isInteger(number)
                        ? number.toString()
                        : number.toFixed(2).replace(/\.?0+$/, '');
                },

                money(value) {
                    return Number(value || 0).toLocaleString('es-MX', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
            };
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</x-app-layout>