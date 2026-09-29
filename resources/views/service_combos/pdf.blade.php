<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Servicios combo</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #1e293b;
        }

        h1 {
            margin: 0;
            font-size: 18px;
        }

        .header {
            margin-bottom: 20px;
        }

        .subtitle {
            margin-top: 5px;
            color: #64748b;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 7px;
            text-align: left;
            font-size: 8px;
        }

        td {
            border: 1px solid #e2e8f0;
            padding: 7px;
            vertical-align: top;
        }

        .codigo {
            font-family: monospace;
            font-weight: bold;
        }

        .productos {
            line-height: 1.5;
        }

        .activo {
            color: #047857;
            font-weight: bold;
        }

        .inactivo {
            color: #64748b;
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 15px;
            color: #64748b;
            font-size: 8px;
        }
    </style>

</head>

<body>

    <div class="header">

        <h1>
            Servicios combo
        </h1>

        <div class="subtitle">
            Fecha de generación:
            {{ now()->format('d/m/Y H:i') }}
        </div>

        @if ($search)

            <div class="subtitle">
                Filtro aplicado: "{{ $search }}"
            </div>

        @endif

    </div>

    <table>

        <thead>

            <tr>

                <th>
                    Código
                </th>

                <th>
                    Servicio
                </th>

                <th>
                    Productos
                </th>

                <th>
                    Costo total
                </th>

                <th>
                    Precio de venta
                </th>

                <th>
                    Ganancia
                </th>

                <th>
                    Estado
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse ($combos as $combo)

                <tr>

                    <td class="codigo">
                        {{ $combo->codigo }}
                    </td>

                    <td>

                        <strong>
                            {{ $combo->nombre }}
                        </strong>

                        @if ($combo->descripcion)

                            <div class="subtitle">
                                {{ $combo->descripcion }}
                            </div>

                        @endif

                    </td>

                    <td class="productos">

                        @forelse ($combo->productos as $item)

                            <div>
                                {{ $item->producto?->nombre ?? 'Producto eliminado' }}
                                ×
                                {{ number_format((float) $item->cantidad, 2) }}
                            </div>

                        @empty

                            Sin productos

                        @endforelse

                    </td>

                    <td class="right">
                        ${{ number_format((float) $combo->costo_total, 2) }}
                    </td>

                    <td class="right">
                        ${{ number_format((float) $combo->precio_venta, 2) }}
                    </td>

                    <td class="right">
                        ${{ number_format((float) $combo->ganancia, 2) }}
                    </td>

                    <td>

                        @if ($combo->activo)

                            <span class="activo">
                                Activo
                            </span>

                        @else

                            <span class="inactivo">
                                Inactivo
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" style="text-align:center;">
                        No hay servicios combo registrados.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">
        Total de servicios:
        {{ $combos->count() }}
    </div>

</body>

</html>