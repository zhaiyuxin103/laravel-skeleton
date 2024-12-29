<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserNameAlias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-name-alias';

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
        $users = User::withTrashed()->get();

        $bar = $this->output->createProgressBar(count($users));

        $bar->start();

        $users->each(function (User $user) use (&$bar) {
            $user->name  = $user->first_name . ' ' . $user->last_name;
            $user->alias = $user->first_alias . ' ' . $user->last_alias;
            $user->save();

            $this->info('User ' . $user->id . ' name and alias updated');

            $bar->advance();
        });

        $bar->finish();
    }
}
