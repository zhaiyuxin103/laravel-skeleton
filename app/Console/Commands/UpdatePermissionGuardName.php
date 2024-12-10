<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class UpdatePermissionGuardName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-permission-guard-name {guard=web}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the guard name for permissions';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $permissions = Permission::all();
        $guard       = $this->argument('guard');
        $bar         = $this->output->createProgressBar($permissions->count());
        $bar->start();
        $permissions->each(function ($permission) use (&$bar, $guard) {
            $permission->guard_name = $guard;
            $permission->save();
            $bar->advance();
        });
        $bar->finish();
    }
}
