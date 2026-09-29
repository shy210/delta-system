<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Proveedores</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b;
            font-size: 10px;
        }

        .header {
            margin-bottom: 24px;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 12px;
        }

        .title {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
        }

        .subtitle {
            margin-top: 5px;
            color: #64748b;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #0f172a;
            color: #ffffff;
            padding: 9px 8px;
            text-align: left;
            font-size: 9px;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        tr:nth-child(even) td {
            background: #f8fafc;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            color: #64748b;
            font-size: 9px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1 class="title">Proveedores</h1>

        <div class="subtitle">
            Listado de proveedores registrados en Delta System
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>WhatsApp</th>
                <th>Teléfono</th>
                <th>Fecha de registro</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suppliers as $supplier)
                <tr>
                    <td>
                        {{ $supplier->nombre }}
                    </td>

                    <td>
                        {{ $supplier->whatsapp ?: '—' }}
                    </td>

                    <td>
                        {{ $supplier->telefono ?: '—' }}
                    </td>

                    <td class="center">
                        {{ $supplier->created_at?->format('d/m/Y H:i') ?? '—' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="center">
                        No hay proveedores registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generado desde Delta System — {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>