<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Opcodes\LogViewer\LogFile;
use Opcodes\LogViewer\LogFolder;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    protected array $users = [
        'zhaiyuxin103@hotmail.com',
        'zhaiyuxin103@gmail.com',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('viewLogViewer', function (?User $user) {
            // return true if the user is allowed access to the Log Viewer
            return in_array($user?->email, $this->users);
        });

        Gate::define('downloadLogFile', function (?User $user, LogFile $file) {
            // return true if the user is allowed to download the specific log file.
            return in_array($user?->email, $this->users);
        });

        Gate::define('downloadLogFolder', function (?User $user, LogFolder $folder) {
            // return true if the user is allowed to download the whole folder.
            return in_array($user?->email, $this->users);
        });

        Gate::define('deleteLogFile', function (?User $user, LogFile $file) {
            // return true if the user is allowed to delete the specific log file.
            return in_array($user?->email, $this->users);
        });

        Gate::define('deleteLogFolder', function (?User $user, LogFolder $folder) {
            // return true if the user is allowed to delete the whole folder.
            return in_array($user?->email, $this->users);
        });
    }
}
