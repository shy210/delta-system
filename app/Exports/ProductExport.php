<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize
{
    public function collection(): Collection
    {
        return Product::query()
            ->with([
                'proveedor',
                'categoriaRelacion',
                'subcategoria',
                'sucursal',
                'series',
            ])
            ->orderBy('nombre')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Producto',
            'Código',
            'Proveedor',
            'Categoría',
            'Subcategoría',
            'Sucursal',
            'Tipo de venta',
            'Existencia',
            'Costo',
            'Precio 1',
            'Precio 2',
            'Precio 3',
            'Precio 4',
            'Precio 5',
            'Precio 6',
            'Ganancia %',
            'Maneja series',
            'Estado',
            'Fecha de registro',
        ];
    }

    public function map($product): array
    {
        $existencia = $product->maneja_series
            ? $product->series->count()
            : (float) $product->stock;

        return [
            $product->nombre,
            $product->codigo,
            $product->proveedor?->nombre ?? 'Sin proveedor',
            $product->categoriaRelacion?->nombre
                ?? $product->categoria
                ?? 'Sin categoría',
            $product->subcategoria?->nombre ?? 'Sin subcategoría',
            $product->sucursal?->nombre ?? 'Sin sucursal',
            match ($product->tipo_venta) {
                'kilogramo' => 'Kilogramo',
                'metro' => 'Metro',
                default => 'Unidad',
            },
            $existencia,
            (float) $product->costo_compra,
            (float) $product->precio_publico,
            $product->precio_2 !== null
                ? (float) $product->precio_2
                : null,
            $product->precio_3 !== null
                ? (float) $product->precio_3
                : null,
            $product->precio_4 !== null
                ? (float) $product->precio_4
                : null,
            $product->precio_5 !== null
                ? (float) $product->precio_5
                : null,
            $product->precio_6 !== null
                ? (float) $product->precio_6
                : null,
            (float) $product->ganancia_porcentaje,
            $product->maneja_series ? 'Sí' : 'No',
            $product->activo ? 'Activo' : 'Inactivo',
            $product->created_at?->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'rgb' => '0F172A',
                    ],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
        ];
    }
}