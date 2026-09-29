<?php

namespace App\Exports;

use App\Models\CreditApplication;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CreditApplicationsExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithColumnWidths
{
    private ?string $search;
    private ?string $period;

    public function __construct(
        ?string $search = null,
        ?string $period = null
    ) {
        $this->search = trim($search ?? '');
        $this->period = $period;
    }

    public function collection(): Collection
    {
        $query = CreditApplication::with('customer');

        if ($this->search !== '') {
            $search = mb_strtolower($this->search);

            $query->whereHas('customer', function ($customerQuery) use ($search) {
                $customerQuery->where(function ($q) use ($search) {
                    $q->whereRaw(
                        "LOWER(CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno)) LIKE ?",
                        ["%{$search}%"]
                    )
                    ->orWhereRaw(
                        'LOWER(empresa) LIKE ?',
                        ["%{$search}%"]
                    )
                    ->orWhereRaw(
                        'LOWER(correo) LIKE ?',
                        ["%{$search}%"]
                    )
                    ->orWhereRaw(
                        'LOWER(telefono) LIKE ?',
                        ["%{$search}%"]
                    );
                });
            });
        }

        if ($this->period) {
            match ($this->period) {
                'today' => $query->whereDate('created_at', today()),

                'yesterday' => $query->whereDate(
                    'created_at',
                    today()->subDay()
                ),

                'week' => $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]),

                'month' => $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year),

                'year' => $query->whereYear('created_at', now()->year),

                default => null,
            };
        }

        return $query
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Tipo de cliente',
            'Ocupación o actividad',
            'Monto solicitado',
            'Moneda',
            'Frecuencia de pago',
            'Estado',
            'Fecha de solicitud',
        ];
    }

    public function map($creditApplication): array
    {
        $customer = $creditApplication->customer;

        $nombreCliente = trim(
            ($customer->nombre ?? '') . ' ' .
            ($customer->apellido_paterno ?? '') . ' ' .
            ($customer->apellido_materno ?? '')
        );

        if (!empty($customer->empresa)) {
            $nombreCliente .= ' — ' . $customer->empresa;
        }

        return [
            $nombreCliente,

            $creditApplication->tipo_cliente === 'persona_fisica'
                ? 'Persona física'
                : 'Persona moral',

            $creditApplication->ocupacion_actividad,

            number_format(
                (float) $creditApplication->cantidad_solicitada,
                2,
                '.',
                ','
            ),

            $creditApplication->moneda,

            ucfirst($creditApplication->frecuencia_pago),

            ucfirst($creditApplication->estado),

            $creditApplication->created_at?->format('d/m/Y H:i'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 42,
            'B' => 20,
            'C' => 32,
            'D' => 20,
            'E' => 12,
            'F' => 20,
            'G' => 18,
            'H' => 24,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        // Encabezados
        $sheet->getStyle('A1:H1')->applyFromArray([
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
            $sheet->getStyle("A2:H{$highestRow}")->applyFromArray([
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

            // Cliente y ocupación alineados a la izquierda
            $sheet->getStyle("A2:A{$highestRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $sheet->getStyle("C2:C{$highestRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // El resto de las columnas centradas
            $sheet->getStyle("B2:H{$highestRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Filtro en los encabezados
        $sheet->setAutoFilter("A1:H{$highestRow}");

        // Congelar la primera fila
        $sheet->freezePane('A2');

        // Altura del encabezado
        $sheet->getRowDimension(1)->setRowHeight(25);

        return [];
    }
}