<?php

namespace App\Exports;

use App\Models\Supplier;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupplierExport implements
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
        return Supplier::query()
            ->when($this->search !== '', function ($query) {
                $search = $this->search;

                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%')
                        ->orWhere('whatsapp', 'like', '%' . $search . '%')
                        ->orWhere('telefono', 'like', '%' . $search . '%')
                        ->orWhere('correo', 'like', '%' . $search . '%')
                        ->orWhere('direccion', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('nombre')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'WhatsApp',
            'Teléfono',
            'Fecha de registro',
        ];
    }

    public function map($supplier): array
    {
        return [
            $supplier->nombre,
            $supplier->whatsapp ?? '',
            $supplier->telefono ?? '',
            $supplier->created_at
                ? $supplier->created_at->format('d/m/Y H:i')
                : '',
        ];
    }

    public function title(): string
    {
        return 'Proveedores';
    }

    public function styles(Worksheet $sheet): array|null
    {
        $lastRow = $sheet->getHighestRow();

        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0F172A'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CBD5E1'],
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(28);

        if ($lastRow >= 2) {
            $sheet->getStyle("A2:D{$lastRow}")->applyFromArray([
                'font' => [
                    'size' => 10,
                    'color' => ['rgb' => '1E293B'],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'E2E8F0'],
                    ],
                ],
            ]);

            for ($row = 2; $row <= $lastRow; $row++) {
                if ($row % 2 === 0) {
                    $sheet->getStyle("A{$row}:D{$row}")
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setRGB('F8FAFC');
                }
            }

            $sheet->getStyle("B2:C{$lastRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle("D2:D{$lastRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        $sheet->setAutoFilter("A1:D{$lastRow}");
        $sheet->freezePane('A2');

        $sheet->getColumnDimension('A')->setWidth(32);
        $sheet->getColumnDimension('B')->setWidth(22);
        $sheet->getColumnDimension('C')->setWidth(22);
        $sheet->getColumnDimension('D')->setWidth(23);

        return [];
    }
}