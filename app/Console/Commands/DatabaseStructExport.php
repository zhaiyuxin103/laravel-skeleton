<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class DatabaseStructExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:database-struct-export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export database structure to Excel file.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Exporting database structure...');

        try {
            Excel::store(new \App\Exports\DatabaseStructExport(), 'database-struct.xlsx');
        } catch (Throwable $th) {
            $this->error('Failed to export database structure.');
        }

        $this->info('Database structure exported successfully.');
    }
}
