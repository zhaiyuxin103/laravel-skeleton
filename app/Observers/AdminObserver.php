<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Admin;
use Illuminate\Support\Carbon;

class AdminObserver
{
    /**
     * Handle the Admin "created" event.
     */
    public function created(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "updated" event.
     */
    public function updated(Admin $admin): void
    {
        //
    }

    /**
     * Handle the User "saving" event.
     */
    public function saving(Admin $admin): void
    {
        if ($admin->isDirty('birthday')) {
            $admin->age = Carbon::parse($admin->birthday)->age;
        }
    }

    /**
     * Handle the Admin "deleted" event.
     */
    public function deleted(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "restored" event.
     */
    public function restored(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "force deleted" event.
     */
    public function forceDeleted(Admin $admin): void
    {
        //
    }
}
