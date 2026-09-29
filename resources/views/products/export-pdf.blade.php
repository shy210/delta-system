<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Productos</title>

    <style>
        @page {
            margin: 30px 25px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #0f172a;
        }

        .header {
            border-bottom: 2px solid #0891b2;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .subtitle {
            margin-top: 4px;
            font-size: 10px;
            color: #64748b;
        }

        .date {
            margin-top: 8px;
            font-size: 8px;
            color: #64748b;
        }

        .filter {
            margin-bottom: 15px;
            padding: 8px 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #475569;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        th {
            background: #0f172a;
            color: white;
            padding: 7px 5px;
            text-align: left;
            font-size: 7.5px;
            font-weight: bold;
        }

        td {
            padding: 6px 5px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
            font-size: 7.5px;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .product-name {
            font-weight: bold;
            color: #0f172a;
        }

        .code {
            font-family: DejaVu Sans Mono, monospace;
            color: #475569;
        }

        .muted {
            color: #64748b;
        }

        .price {
            white-space: nowrap;
        }

        .footer {
            margin-top: 18px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
            font-size: 8px;
            color: #64748b;
            text-align: right;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">
            Inventario de productos
        </div>

        <div class="subtitle">
            Reporte de productos registrados en el sistema.
        </div>

        <div class="date">
            Generado el {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>

    @if($search)
        <div class="filter">
            <strong>Filtro aplicado:</strong>
            {{ $search }}
        </div>
    @endif

    @if($products->count())

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Código</th>
                    <th>Proveedor</th>
                    <th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Sucursal</th>
                    <th>Venta</th>
                    <th class="text-center">Existencia</th>
                    <th class="text-right">Costo</th>
                    <th class="text-right">Precio 1</th>
                    <th class="text-right">Precio 2</th>
                    <th class="text-right">Precio 3</th>
                    <th class="text-right">Precio 4</th>
                    <th class="text-right">Precio 5</th>
                    <th class="text-right">Precio 6</th>
                    <th class="text-right">Ganancia</th>
                    <th class="text-center">Series</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)

                    @php
                        $existencia = $product->maneja_series
                            ? $product->series->count()
                            : (float) $product->stock;

                        $tipoVenta = match ($product->tipo_venta) {
                            'kilogramo' => 'Kilogramo',
                            'metro' => 'Metro',
                            default => 'Unidad',
                        };
                    @endphp

                    <tr>
                        <td>
                            <div class="product-name">
                                {{ $product->nombre }}
                            </div>

                            @if($product->referencia)
                                <div class="muted">
                                    Ref. {{ $product->referencia }}
                                </div>
                            @endif
                        </td>

                        <td class="code">
                            {{ $product->codigo }}
                        </td>

                        <td>
                            {{ $product->proveedor?->nombre ?? 'Sin proveedor' }}
                        </td>

                        <td>
                            {{ $product->categoriaRelacion?->nombre
                                ?? $product->categoria
                                ?? 'Sin categoría' }}
                        </td>

                        <td>
                            {{ $product->subcategoria?->nombre ?? 'Sin subcategoría' }}
                        </td>

                        <td>
                            {{ $product->sucursal?->nombre ?? 'Sin sucursal' }}
                        </td>

                        <td>
                            {{ $tipoVenta }}
                        </td>

                        <td class="text-center">
                            {{ number_format($existencia, 2) }}
                        </td>

                        <td class="text-right price">
                            ${{ number_format((float) $product->costo_compra, 2) }}
                        </td>

                        <td class="text-right price">
                            ${{ number_format((float) $product->precio_publico, 2) }}
                        </td>

                        <td class="text-right price">
                            @if($product->precio_2 !== null)
                                ${{ number_format((float) $product->precio_2, 2) }}
                            @else
                                —
                            @endif
                        </td>

                        <td class="text-right price">
                            @if($product->precio_3 !== null)
                                ${{ number_format((float) $product->precio_3, 2) }}
                            @else
                                —
                            @endif
                        </td>

                        <td class="text-right price">
                            @if($product->precio_4 !== null)
                                ${{ number_format((float) $product->precio_4, 2) }}
                            @else
                                —
                            @endif
                        </td>

                        <td class="text-right price">
                            @if($product->precio_5 !== null)
                                ${{ number_format((float) $product->precio_5, 2) }}
                            @else
                                —
                            @endif
                        </td>

                        <td class="text-right price">
                            @if($product->precio_6 !== null)
                                ${{ number_format((float) $product->precio_6, 2) }}
                            @else
                                —
                            @endif
                        </td>

                        <td class="text-right">
                            {{ number_format((float) $product->ganancia_porcentaje, 2) }}%
                        </td>

                        <td class="text-center">
                            {{ $product->maneja_series ? 'Sí' : 'No' }}
                        </td>

                        <td class="text-center">
                            {{ $product->activo ? 'Activo' : 'Inactivo' }}
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    @else

        <div class="empty">
            No hay productos para mostrar.
        </div>

    @endif

    <div class="footer">
        Total de productos: {{ $products->count() }}
    </div>

</body>
</html>