<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Categorías
    </title>

    <style>

        @page {
            margin: 35px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111827;
        }

        .header {
            margin-bottom: 25px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 11px;
            color: #6b7280;
        }

        .search {
            margin-top: 8px;
            font-size: 10px;
            color: #4b5563;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #e5e7eb;
            color: #111827;
            font-size: 10px;
            font-weight: bold;
            text-align: left;
            padding: 9px;
            border: 1px solid #d1d5db;
        }

        td {
            padding: 9px;
            border: 1px solid #d1d5db;
            font-size: 10px;
        }

        .tipo-padre {
            font-weight: bold;
            color: #1d4ed8;
        }

        .tipo-hija {
            font-weight: bold;
            color: #7c3aed;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #6b7280;
            text-align: right;
        }

    </style>

</head>

<body>

    <div class="header">

        <div class="title">
            Categorías
        </div>

        <div class="subtitle">
            Directorio de categorías de Delta System
        </div>

        <div class="subtitle">
            Fecha de generación:
            {{ now()->format('d/m/Y H:i') }}
        </div>

        @if ($search)

            <div class="search">
                Búsqueda:
                {{ $search }}
            </div>

        @endif

    </div>


    <table>

        <thead>

            <tr>

                <th>
                    Nombre
                </th>

                <th>
                    Tipo
                </th>

                <th>
                    Categoría padre
                </th>

                <th>
                    Fecha de registro
                </th>

                <th>
                    Fecha de actualización
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($categories as $category)

                <tr>

                    <td>
                        {{ $category->nombre }}
                    </td>

                    <td>

                        @if ($category->tipo === 'padre')

                            <span class="tipo-padre">
                                Padre
                            </span>

                        @else

                            <span class="tipo-hija">
                                Hija
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $category->categoriaPadre?->nombre ?? 'Sin categoría padre' }}
                    </td>

                    <td>
                        {{ optional($category->created_at)->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        {{ optional($category->updated_at)->format('d/m/Y H:i') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" style="text-align: center;">
                        Ningún dato disponible en esta tabla
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <div class="footer">

        Total de categorías:
        {{ $categories->count() }}

    </div>

</body>

</html>