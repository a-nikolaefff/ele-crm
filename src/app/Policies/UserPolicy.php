<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return $user->isAdminOrSuperAdmin();
    }

    public function update(User $user, User $targetUser): bool
    {
        if ($user->isAdminOrSuperAdmin()) {
            if ($targetUser->isSuperAdmin()) {
                return $user->id === $targetUser->id;
            }
            return true;
        }
        return false;
    }

    public function delete(User $user, User $targetUser): bool
    {
        if ($user->isAdminOrSuperAdmin()) {
            if ($targetUser->isSuperAdmin()) {
                return false;
            }
            return true;
        }
        return false;
    }
}
