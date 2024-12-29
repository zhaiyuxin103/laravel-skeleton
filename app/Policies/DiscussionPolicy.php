<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Admin;
use App\Models\Discussion;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_discussion');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Discussion $discussion): bool
    {
        return $admin->can('view_discussion');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_discussion');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Discussion $discussion): bool
    {
        return $admin->can('update_discussion');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Discussion $discussion): bool
    {
        return $admin->can('delete_discussion');
    }

    /**
     * Determine whether the admin can bulk delete.
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_discussion');
    }

    /**
     * Determine whether the admin can permanently delete.
     */
    public function forceDelete(Admin $admin, Discussion $discussion): bool
    {
        return $admin->can('force_delete_discussion');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('force_delete_any_discussion');
    }

    /**
     * Determine whether the admin can restore.
     */
    public function restore(Admin $admin, Discussion $discussion): bool
    {
        return $admin->can('restore_discussion');
    }

    /**
     * Determine whether the admin can bulk restore.
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_discussion');
    }

    /**
     * Determine whether the admin can replicate.
     */
    public function replicate(Admin $admin, Discussion $discussion): bool
    {
        return $admin->can('replicate_discussion');
    }

    /**
     * Determine whether the admin can reorder.
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_discussion');
    }
}
