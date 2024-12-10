<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_category');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Category $category): bool
    {
        return $admin->can('view_category');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_category');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Category $category): bool
    {
        return $admin->can('update_category');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Category $category): bool
    {
        return $admin->can('delete_category');
    }

    /**
     * Determine whether the admin can bulk delete.
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_category');
    }

    /**
     * Determine whether the admin can permanently delete.
     */
    public function forceDelete(Admin $admin, Category $category): bool
    {
        return $admin->can('force_delete_category');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('force_delete_any_category');
    }

    /**
     * Determine whether the admin can restore.
     */
    public function restore(Admin $admin, Category $category): bool
    {
        return $admin->can('restore_category');
    }

    /**
     * Determine whether the admin can bulk restore.
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_category');
    }

    /**
     * Determine whether the admin can replicate.
     */
    public function replicate(Admin $admin, Category $category): bool
    {
        return $admin->can('replicate_category');
    }

    /**
     * Determine whether the admin can reorder.
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_category');
    }
}
