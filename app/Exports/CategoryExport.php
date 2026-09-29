<?php

namespace App\Exports;

use App\Models\Category;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CategoryExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithTitle
{
    protected string $search;

    public function __construct(?string $search = null)
    {
        $this->search = $search ?? '';
    }

    public function collection(): Enumerable
    {
        return Category::with('categoriaPadre')
            ->when($this->search !== '', function ($query) {
                $search = $this->search;

                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%')
                        ->orWhere('tipo', 'like', '%' . $search . '%')
                        ->orWhereHas('categoriaPadre', function ($parentQuery) use ($search) {
                            $parentQuery->where(
                                'nombre',
                                'like',
                                '%' . $search . '%'
                            );
                        });
                });
            })
            ->orderBy('nombre')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Tipo',
            'Categoría padre',
            'Fecha de registro',
            'Fecha de actualización',
        ];
    }

    public function map($category): array
    {
        return [
            $category->nombre,

            $category->tipo === 'padre'
                ? 'Padre'
                : 'Hija',

            $category->categoriaPadre?->nombre
                ?? 'Sin categoría padre',

            $category->created_at
                ? $category->created_at->format('d/m/Y H:i')
                : '',

            $category->updated_at
                ? $category->updated_at->format('d/m/Y H:i')
                : '',
        ];
    }

    public function title(): string
    {
        return 'Categorías';
    }

    public function styles(Worksheet $sheet): array|null
    {
        $lastRow = $sheet->getHighestRow();

        // Encabezados
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '0F172A',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => [
                        'rgb' => 'CBD5E1',
                    ],
                ],
            ],
        ]);

        // Altura del encabezado
        $sheet->getRowDimension(1)->setRowHeight(28);

        // Contenido de la tabla
        if ($lastRow >= 2) {
            $sheet->getStyle("A2:E{$lastRow}")->applyFromArray([
                'font' => [
                    'size' => 10,
                    'color' => [
                        'rgb' => '1E293B',
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'rgb' => 'E2E8F0',
                        ],
                    ],
                ],
            ]);

            // Filas alternadas
            for ($row = 2; $row <= $lastRow; $row++) {
                if ($row % 2 === 0) {
                    $sheet->getStyle("A{$row}:E{$row}")
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setRGB('F8FAFC');
                }
            }

            // Centrar tipo
            $sheet->getStyle("B2:B{$lastRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Centrar fechas
            $sheet->getStyle("D2:E{$lastRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Filtro automático
        $sheet->setAutoFilter("A1:E{$lastRow}");

        // Congelar encabezado
        $sheet->freezePane('A2');

        // Anchos
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(16);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(23);
        $sheet->getColumnDimension('E')->setWidth(23);

        return [];
    }
}