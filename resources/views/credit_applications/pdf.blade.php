
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Líneas de crédito</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #1e293b;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            color: #1e293b;
            font-size: 22px;
        }

        .header p {
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
        }

        .filters {
            margin-bottom: 15px;
            color: #475569;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1e293b;
            color: white;
            padding: 8px 5px;
            text-align: left;
            font-size: 9px;
        }

        td {
            border: 1px solid #cbd5e1;
            padding: 7px 5px;
            vertical-align: middle;
            font-size: 8px;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            color: #64748b;
            font-size: 9px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Delta System</h1>
        <p>Reporte de líneas de crédito</p>
    </div>

    <div class="filters">
        <strong>Filtro de búsqueda:</strong>
        {{ $search ?: 'Todos los registros' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Tipo de cliente</th>
                <th>Ocupación o actividad</th>
                <th>Monto solicitado</th>
                <th>Moneda</th>
                <th>Frecuencia de pago</th>
                <th>Estado</th>
                <th>Fecha de solicitud</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($creditApplications as $application)
                <tr>
                    <td>
                        @if ($application->customer)
                            {{ trim(
                                $application->customer->nombre . ' ' .
                                $application->customer->apellido_paterno . ' ' .
                                $application->customer->apellido_materno
                            ) }}

                            @if ($application->customer->empresa)
                                <br>
                                <small>
                                    {{ $application->customer->empresa }}
                                </small>
                            @endif
                        @else
                            Sin cliente
                        @endif
                    </td>

                    <td>
                        {{ ucfirst(str_replace('_', ' ', $application->tipo_cliente ?? 'No especificado')) }}
                    </td>

                    <td>
                        {{ $application->ocupacion_actividad ?? 'No especificada' }}
                    </td>

                    <td>
                        ${{ number_format((float) $application->cantidad_solicitada, 2) }}
                    </td>

                    <td>
                        {{ $application->moneda ?? 'MXN' }}
                    </td>

                    <td>
                        {{ ucfirst(str_replace('_', ' ', $application->frecuencia_pago ?? 'No especificada')) }}
                    </td>

                    <td>
                        {{ ucfirst($application->estado ?? 'Pendiente') }}
                    </td>

                    <td>
                        {{ $application->created_at?->format('d/m/Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        No hay solicitudes de crédito registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generado el {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>