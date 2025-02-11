<?php

declare(strict_types=1);

namespace App\Exports\Sheets;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TableSheet implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithTitle
{
    public array $columns;

    public function __construct(public array $table)
    {
        $this->columns = DB::select('SHOW FULL COLUMNS FROM ' . data_get($this->table, 'name'));
    }

    public function title(): string
    {
        return data_get($this->table, 'name');
    }

    public function columnWidths(): array
    {
        return [
            'B' => 20,
        ];
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('B2:C4')->getBorders()->applyFromArray([
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ]);
        $sheet->getStyle('B6:H' . (count($this->columns) + 6))->getBorders()->applyFromArray([
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ]);
    }

    public function view(): View
    {
        return view('exports.database_struct.table', [
            'table'   => $this->table,
            'columns' => $this->columns,
        ]);
    }
}
