<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Ajustes de inventario</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #0f172a;
        }

        h1 {
            margin: 0;
            font-size: 18px;
        }

        .subtitle {
            margin-top: 4px;
            color: #64748b;
            font-size: 9px;
        }

        .filter {
            margin-top: 8px;
            color: #475569;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th {
            background: #0f172a;
            color: white;
            padding: 7px;
            text-align: left;
            font-size: 8px;
        }

        td {
            border-bottom: 1px solid #e2e8f0;
            padding: 6px;
            vertical-align: top;
        }

        .entrada {
            color: #047857;
            font-weight: bold;
        }

        .salida {
            color: #c2410c;
            font-weight: bold;
        }

        .aprobado {
            color: #047857;
            font-weight: bold;
        }

        .rechazado {
            color: #b91c1c;
            font-weight: bold;
        }

        .pendiente {
            color: #b45309;
            font-weight: bold;
        }

        .footer {
            margin-top: 18px;
            color: #64748b;
            font-size: 8px;
        }
    </style>
</head>

<body>

    <h1>Ajustes de inventario</h1>

    <div class="subtitle">
        Reporte generado el {{ now()->format('d/m/Y H:i') }}
    </div>

    @if ($search)
        <div class="filter">
            Filtro aplicado: "{{ $search }}"
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Operación</th>
                <th>Producto</th>
                <th>Código</th>
                <th>Cantidad</th>
                <th>Fecha registro</th>
                <th>Usuario registro</th>
                <th>Usuario aprobó</th>
                <th>Fecha aprobó</th>
                <th>Estatus</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($adjustments as $adjustment)
                <tr>

                    <td>
                        <span class="{{ $adjustment->tipo }}">
                            {{ $adjustment->tipo === 'entrada' ? 'Entrada' : 'Salida' }}
                        </span>
                    </td>

                    <td>
                        {{ $adjustment->descripcion ?: 'Ajuste de inventario' }}
                    </td>

                    <td>
                        {{ $adjustment->producto?->nombre ?? 'Producto eliminado' }}
                    </td>

                    <td>
                        {{ $adjustment->codigo_barras ?? $adjustment->producto?->codigo ?? '—' }}
                    </td>

                    <td>
                        {{ number_format((float) $adjustment->cantidad, 2) }}
                    </td>

                    <td>
                        {{ $adjustment->created_at?->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        {{ $adjustment->usuarioRegistro?->name ?? '—' }}
                    </td>

                    <td>
                        {{ $adjustment->usuarioAprobo?->name ?? '—' }}
                    </td>

                    <td>
                        {{ $adjustment->fecha_aprobacion?->format('d/m/Y H:i') ?? '—' }}
                    </td>

                    <td>
                        @if ($adjustment->estatus === 'aprobado')
                            <span class="aprobado">Aprobado</span>
                        @elseif ($adjustment->estatus === 'rechazado')
                            <span class="rechazado">Rechazado</span>
                        @else
                            <span class="pendiente">Pendiente</span>
                        @endif
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="10">
                        No hay ajustes registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Total de registros: {{ $adjustments->count() }}
    </div>

</body>
</html>