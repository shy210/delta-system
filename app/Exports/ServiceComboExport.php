<?php

namespace App\Exports;

use App\Models\ServiceCombo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ServiceComboExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize
{
    public function collection(): Collection
    {
        return ServiceCombo::query()
            ->with('productos.producto')
            ->orderBy('nombre')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Servicio',
            'Código',
            'Descripción',
            'Productos incluidos',
            'Costo total',
            'Precio de venta',
            'Ganancia',
            'Estado',
            'Fecha de registro',
        ];
    }

    public function map($serviceCombo): array
    {
        $productos = $serviceCombo->productos
            ->map(function ($item) {
                $nombre = $item->producto?->nombre
                    ?? 'Producto eliminado';

                return $nombre .
                    ' x ' .
                    number_format(
                        (float) $item->cantidad,
                        2
                    );
            })
            ->implode(', ');

        return [
            $serviceCombo->nombre,
            $serviceCombo->codigo,
            $serviceCombo->descripcion ?? 'Sin descripción',
            $productos ?: 'Sin productos',
            (float) $serviceCombo->costo_total,
            (float) $serviceCombo->precio_venta,
            (float) $serviceCombo->ganancia,
            $serviceCombo->activo
                ? 'Activo'
                : 'Inactivo',
            $serviceCombo->created_at?->format(
                'd/m/Y H:i'
            ),
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