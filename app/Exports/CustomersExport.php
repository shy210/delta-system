<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomersExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithColumnWidths
{
    private ?string $search;

    public function __construct(?string $search = null)
    {
        $this->search = trim($search ?? '');
    }

    public function collection(): Collection
    {
        $query = Customer::query();

        if ($this->search !== '') {
            $search = mb_strtolower($this->search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw(
                    "LOWER(CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno)) LIKE ?",
                    ["%{$search}%"]
                )
                ->orWhereRaw(
                    'LOWER(telefono) LIKE ?',
                    ["%{$search}%"]
                )
                ->orWhereRaw(
                    'LOWER(whatsapp) LIKE ?',
                    ["%{$search}%"]
                )
                ->orWhereRaw(
                    'LOWER(correo) LIKE ?',
                    ["%{$search}%"]
                );
            });
        }

        return $query
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Teléfono',
            'WhatsApp',
            'Correo',
        ];
    }

    public function map($customer): array
    {
        return [
            trim(
                $customer->nombre . ' ' .
                $customer->apellido_paterno . ' ' .
                $customer->apellido_materno
            ),
            $customer->telefono,
            $customer->whatsapp,
            $customer->correo,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 38,
            'B' => 20,
            'C' => 20,
            'D' => 38,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        // Encabezados
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '1E293B',
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

        // Toda la tabla
        $highestRow = $sheet->getHighestRow();

        if ($highestRow >= 2) {
            $sheet->getStyle("A2:D{$highestRow}")->applyFromArray([
                'font' => [
                    'size' => 11,
                    'color' => [
                        'rgb' => '334155',
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

            // Nombre y correo alineados a la izquierda
            $sheet->getStyle("A2:A{$highestRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $sheet->getStyle("D2:D{$highestRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // Teléfono y WhatsApp centrados
            $sheet->getStyle("B2:C{$highestRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Filtro en los encabezados
        $sheet->setAutoFilter("A1:D{$highestRow}");

        // Congelar la primera fila
        $sheet->freezePane('A2');

        // Altura del encabezado
        $sheet->getRowDimension(1)->setRowHeight(25);

        return [];
    }
}