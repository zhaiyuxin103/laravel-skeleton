<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\text;

class UpdateUserToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-to-admin {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user to admin';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($id = (int) $this->option('id')) {
            if ($user = User::find($id)) {
                $this->updateUserToAdmin($user);
            } else {
                $this->error("User with ID {$id} not found.");
            }
        } else {
            $users = User::select(['id', 'first_name', 'last_name', 'email'])->get();

            if ($users->isEmpty()) {
                $this->error('No users found.');
            } elseif ($users->count() === 1) {
                $this->updateUserToAdmin($users->first());
            } else {
                $this->table(
                    headers: ['ID', 'Name', 'Email'],
                    rows: $users->map(fn ($user) => [
                        'id'    => $user->id,
                        'name'  => $user->name,
                        'email' => $user->email,
                    ])->toArray()
                );

                $id = text(
                    label: 'Enter the user ID to update to admin:',
                    required: true,
                    validate: ['required', 'numeric', Rule::exists('users', 'id')->whereNull('deleted_at')],
                );

                $this->updateUserToAdmin(User::find($id));
            }
        }
    }

    private function updateUserToAdmin(User $user): void
    {
        $user->is_admin = true;
        $user->save();
        $this->info("User with ID {$user->id} has been updated to admin.");
    }
}
