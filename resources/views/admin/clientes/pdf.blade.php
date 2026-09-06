<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Listado de clientes - Delta System</title>

    <style>
        @page {
            margin: 35px 30px 40px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #334155;
            font-size: 11px;
            margin: 0;
        }

        .header {
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 2px solid #1e293b;
            padding-bottom: 15px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
            color: #475569;
            margin-bottom: 5px;
        }

        .info {
            font-size: 9px;
            color: #64748b;
        }

        .search-info {
            margin-top: 5px;
            font-size: 9px;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        th {
            background-color: #1e293b;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            padding: 9px 8px;
            text-align: left;
            border: 1px solid #1e293b;
        }

        td {
            padding: 8px;
            border: 1px solid #cbd5e1;
            font-size: 10px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .name {
            font-weight: bold;
            color: #334155;
        }

        .phone {
            text-align: center;
            white-space: nowrap;
        }

        .email {
            color: #475569;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="brand">
            Delta System
        </div>

        <div class="title">
            Listado de clientes
        </div>

        <div class="info">
            Fecha de generación:
            {{ now()->format('d/m/Y H:i') }}
        </div>

        @if(!empty($search))
            <div class="search-info">
                Filtro aplicado:
                <strong>{{ $search }}</strong>
            </div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 35%;">
                    Nombre
                </th>

                <th style="width: 20%;">
                    Teléfono
                </th>

                <th style="width: 20%;">
                    WhatsApp
                </th>

                <th style="width: 25%;">
                    Correo
                </th>
            </tr>
        </thead>

        <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td class="name">
                        {{ trim(
                            $customer->nombre . ' ' .
                            $customer->apellido_paterno . ' ' .
                            $customer->apellido_materno
                        ) }}
                    </td>

                    <td class="phone">
                        {{ $customer->telefono }}
                    </td>

                    <td class="phone">
                        {{ $customer->whatsapp }}
                    </td>

                    <td class="email">
                        {{ $customer->correo }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">
                        No se encontraron clientes.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Delta System · Listado de clientes
    </div>

</body>
</html>