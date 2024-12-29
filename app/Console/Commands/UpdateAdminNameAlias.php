<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;

class UpdateAdminNameAlias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-admin-name-alias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $admins = Admin::withTrashed()->get();

        $bar = $this->output->createProgressBar(count($admins));

        $bar->start();

        $admins->each(function (Admin $admin) use (&$bar) {
            $admin->name  = $admin->first_name . ' ' . $admin->last_name;
            $admin->alias = $admin->first_alias . ' ' . $admin->last_alias;
            $admin->save();

            $this->info('User ' . $admin->id . ' name and alias updated');

            $bar->advance();
        });

        $bar->finish();
    }
}
