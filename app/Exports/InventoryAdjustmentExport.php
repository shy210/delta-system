<?php

namespace App\Exports;

use App\Models\InventoryAdjustment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryAdjustmentExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize
{
    protected ?string $search;

    public function __construct(?string $search = null)
    {
        $this->search = $search;
    }

    public function collection(): Collection
    {
        return InventoryAdjustment::query()
            ->with([
                'producto',
                'usuarioRegistro',
                'usuarioAprobo',
            ])
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tipo', 'like', "%{$search}%")
                        ->orWhere('descripcion', 'like', "%{$search}%")
                        ->orWhere('codigo_barras', 'like', "%{$search}%")
                        ->orWhere('estatus', 'like', "%{$search}%")
                        ->orWhereHas('producto', function ($productQuery) use ($search) {
                            $productQuery
                                ->where('nombre', 'like', "%{$search}%")
                                ->orWhere('codigo', 'like', "%{$search}%");
                        })
                        ->orWhereHas('usuarioRegistro', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tipo',
            'Operación',
            'Producto',
            'Código de barras',
            'Cantidad',
            'Fecha registro',
            'Usuario registro',
            'Usuario aprobó',
            'Fecha aprobó',
            'Estatus',
        ];
    }

    public function map($adjustment): array
    {
        return [
            $adjustment->tipo === 'entrada'
                ? 'Entrada'
                : 'Salida',

            $adjustment->descripcion ?: 'Ajuste de inventario',

            $adjustment->producto?->nombre ?? 'Producto eliminado',

            $adjustment->codigo_barras
                ?? $adjustment->producto?->codigo
                ?? 'Sin código',

            (float) $adjustment->cantidad,

            $adjustment->created_at?->format('d/m/Y H:i'),

            $adjustment->usuarioRegistro?->name ?? 'Sin usuario',

            $adjustment->usuarioAprobo?->name ?? 'Pendiente',

            $adjustment->fecha_aprobacion
                ? $adjustment->fecha_aprobacion->format('d/m/Y H:i')
                : 'Pendiente',

            match ($adjustment->estatus) {
                'aprobado' => 'Aprobado',
                'rechazado' => 'Rechazado',
                default => 'Pendiente',
            },
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