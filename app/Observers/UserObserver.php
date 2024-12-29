<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Carbon;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "saving" event.
     */
    public function saving(User $user): void
    {
        if ($user->isDirty('birthday')) {
            $user->age = Carbon::parse($user->birthday)->age;
        }
        if ($user->isDirty(['first_name', 'last_name'])) {
            $user->name = $user->first_name . ' ' . $user->last_name;
        }
        if ($user->isDirty(['first_alias', 'last_alias'])) {
            $user->alias = $user->first_alias . ' ' . $user->last_alias;
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
