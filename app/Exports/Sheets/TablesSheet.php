<?php

declare(strict_types=1);

namespace App\Exports\Sheets;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TablesSheet implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithTitle
{
    public function __construct(public array $tables)
    {
    }

    public function title(): string
    {
        return 'テーブル一覧';
    }

    public function columnWidths(): array
    {
        return [
            'B' => 10,
        ];
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('B2')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('B3:D57')->getBorders()->applyFromArray([
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ]);
    }

    public function view(): View
    {
        return view('exports.database_struct.tables', [
            'tables' => $this->tables,
        ]);
    }
}
