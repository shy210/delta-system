<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Detalles de la línea de crédito
                </h2>

                <p class="text-sm text-slate-500">
                    Consulta la información de la solicitud.
                </p>
            </div>

            <a
                href="{{ route('credit-applications.index') }}"
                class="rounded-xl bg-slate-200 px-4 py-2 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-300"
            >
                Regresar
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl space-y-6">

            {{-- Encabezado --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-medium text-cyan-600">
                            Solicitud de crédito
                        </p>

                        <h1 class="mt-1 text-2xl font-bold text-slate-800">
                            {{ $creditApplication->customer->nombre ?? 'Sin cliente' }}
                            {{ $creditApplication->customer->apellido_paterno ?? '' }}
                            {{ $creditApplication->customer->apellido_materno ?? '' }}
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            Registrada el
                            {{ $creditApplication->created_at?->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    @php
                        $estado = $creditApplication->estado;

                        $estadoClases = [
                            'pendiente' => 'bg-amber-100 text-amber-700',
                            'aprobada' => 'bg-emerald-100 text-emerald-700',
                            'rechazada' => 'bg-red-100 text-red-700',
                            'cancelada' => 'bg-slate-200 text-slate-700',
                        ];
                    @endphp

                    <span class="{{ $estadoClases[$estado] ?? 'bg-slate-100 text-slate-700' }} rounded-full px-4 py-2 text-center text-sm font-semibold">
                        {{ ucfirst($estado) }}
                    </span>
                </div>
            </div>

            {{-- Información del cliente --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-bold text-slate-800">
                    Información del cliente
                </h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-slate-500">Nombre completo</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->customer->nombre ?? 'No disponible' }}
                            {{ $creditApplication->customer->apellido_paterno ?? '' }}
                            {{ $creditApplication->customer->apellido_materno ?? '' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Empresa</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->customer->empresa ?? 'No registrada' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Teléfono</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->customer->telefono ?? 'No registrado' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Correo electrónico</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->customer->correo ?? 'No registrado' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Información del crédito --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-bold text-slate-800">
                    Información del crédito
                </h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <p class="text-sm text-slate-500">Tipo de cliente</p>
                        <p class="font-semibold text-slate-800">
                            {{ ucfirst(str_replace('_', ' ', $creditApplication->tipo_cliente ?? 'No registrado')) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Cantidad solicitada</p>
                        <p class="font-semibold text-slate-800">
                            {{ number_format((float) $creditApplication->cantidad_solicitada, 2) }}
                            {{ $creditApplication->moneda }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Frecuencia de pago</p>
                        <p class="font-semibold text-slate-800">
                            {{ ucfirst($creditApplication->frecuencia_pago ?? 'No registrada') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Ocupación o actividad</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->ocupacion_actividad ?? 'No registrada' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Teléfono de trabajo</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->telefono_trabajo ?? 'No registrado' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Referencia personal</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->referencia_personal ?? 'No registrada' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Teléfono de referencia</p>
                        <p class="font-semibold text-slate-800">
                            {{ $creditApplication->telefono_referencia ?? 'No registrado' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Observaciones --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h3 class="mb-3 text-lg font-bold text-slate-800">
                    Observaciones
                </h3>

                <p class="whitespace-pre-line text-sm text-slate-600">
                    {{ $creditApplication->observaciones_adicionales ?: 'Sin observaciones adicionales.' }}
                </p>

                @if ($creditApplication->observaciones_monto)
                    <div class="mt-4 border-t border-slate-200 pt-4">
                        <p class="mb-1 text-sm font-semibold text-slate-700">
                            Observaciones del monto
                        </p>

                        <p class="whitespace-pre-line text-sm text-slate-600">
                            {{ $creditApplication->observaciones_monto }}
                        </p>
                    </div>
                @endif
            </div>

            {{-- Documentos --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-bold text-slate-800">
                    Documentos adjuntos
                </h3>

                @forelse ($creditApplication->documents as $document)
                    <div class="flex flex-col gap-3 border-b border-slate-200 py-4 last:border-0 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="font-semibold text-slate-800">
                                {{ ucfirst(str_replace('_', ' ', $document->tipo_documento)) }}
                            </p>

                            <p class="text-sm text-slate-500">
                                Estado: {{ ucfirst($document->estado ?? 'pendiente') }}
                            </p>
                        </div>

                        <a
                            href="{{ Storage::disk('public')->url($document->archivo) }}"
                            target="_blank"
                            class="rounded-xl bg-cyan-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-cyan-700"
                        >
                            Ver documento
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">
                        No hay documentos adjuntos.
                    </p>
                @endforelse
            </div>

            {{-- Acciones --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('credit-applications.edit', $creditApplication) }}"
                    class="rounded-xl bg-cyan-600 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-cyan-700"
                >
                    Editar solicitud
                </a>

                <form
                    action="{{ route('credit-applications.destroy', $creditApplication) }}"
                    method="POST"
                    onsubmit="return confirm('¿Estás segura de eliminar esta solicitud de crédito?');"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700 sm:w-auto"
                    >
                        Eliminar solicitud
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>