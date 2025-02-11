<?php

declare(strict_types=1);

namespace App\Exports;

use DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DatabaseStructExport implements WithMultipleSheets
{
    public array $tables;

    public array $descriptions;

    public function __construct()
    {
        $this->tables = array_map(function ($table) {
            $key = 'Tables_in_' . Str::lower(DB::connection()->getDatabaseName());

            // 获取表注释
            $comment = DB::select('SHOW TABLE STATUS WHERE Name = ?', [$table->{$key}])[0]->Comment;

            return [
                'name'        => $table->{$key},
                'title'       => $comment,
                'description' => $comment,
            ];
        }, DB::select('SHOW TABLES'));
    }

    public function sheets(): array
    {
        return array_merge([
            new Sheets\TablesSheet($this->tables),
        ], array_map(function ($table) {
            return new Sheets\TableSheet($table);
        }, $this->tables));
    }
}
