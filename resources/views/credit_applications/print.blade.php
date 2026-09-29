
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Imprimir líneas de crédito</title>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }

        body {
            font-family: Arial, sans-serif;
            color: #1e293b;
            margin: 25px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
        }

        .header p {
            color: #64748b;
        }

        .actions {
            margin-bottom: 20px;
        }

        button {
            background-color: #1e293b;
            color: white;
            border: none;
            padding: 10px 18px;
            cursor: pointer;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th {
            background-color: #1e293b;
            color: white;
            padding: 10px 6px;
            text-align: left;
        }

        td {
            border: 1px solid #cbd5e1;
            padding: 8px 6px;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        @media print {
            th {
                background-color: #1e293b !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            tr:nth-child(even) {
                background-color: #f8fafc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <div class="actions no-print">
        <button onclick="window.print()">
            Imprimir
        </button>
    </div>

    <div class="header">
        <h1>Delta System</h1>
        <p>Reporte de líneas de crédito</p>
    </div>

    <p>
        <strong>Búsqueda:</strong>
        {{ $search ?: 'Todos los registros' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Ocupación</th>
                <th>Monto</th>
                <th>Moneda</th>
                <th>Frecuencia</th>
                <th>Estado</th>
                <th>Fecha</th>
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
                                {{ $application->customer->empresa }}
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

</body>
</html>