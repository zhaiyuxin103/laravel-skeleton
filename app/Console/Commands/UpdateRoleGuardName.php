<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class UpdateRoleGuardName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-role-guard-name {guard=web}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the guard name for roles';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $roles = Role::all();
        $guard = $this->argument('guard');
        $bar   = $this->output->createProgressBar($roles->count());
        $bar->start();
        $roles->each(function ($role) use (&$bar, $guard) {
            $role->guard_name = $guard;
            $role->save();
            $bar->advance();
        });
        $bar->finish();
    }
}
