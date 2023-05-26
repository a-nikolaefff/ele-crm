<?php

namespace App\Policies;

use App\Enums\UserRoleType;
use App\Models\User;
use App\Models\UserRole;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(UserRoleType::SuperAdmin, UserRoleType::Admin);
    }

    public function update(
        User $user,
        User $targetUser,
        int $newTargetUserRoleId = null
    ): bool {
        if ($user->hasRole(UserRoleType::SuperAdmin)) {
            if ($targetUser->hasRole(UserRoleType::SuperAdmin)) {
                return false;
            }
            if (isset($newTargetUserRoleId)) {
                $superAdminRoleId = UserRole::getRole(UserRoleType::SuperAdmin)
                    ->get()->first()->id;
                return $newTargetUserRoleId !== $superAdminRoleId;
            } else {
                return true;
            }
        }

        if ($user->hasRole(UserRoleType::Admin)) {
            if ($targetUser->hasAnyRole(
                UserRoleType::SuperAdmin,
                UserRoleType::Admin
            )
            ) {
                return false;
            }

            if (isset($newTargetUserRoleId)) {
                $AllAdminRoleId = [
                    UserRole::getRole(UserRoleType::SuperAdmin)
                        ->get()->first()->id,
                    UserRole::getRole(UserRoleType::Admin)
                        ->get()->first()->id,
                ];
                return !in_array(
                    $newTargetUserRoleId,
                    $AllAdminRoleId,
                    true
                );
            } else {
                return true;
            }
        }
        return false;
    }

    public function delete(User $user, User $targetUser): bool
    {
        if ($user->hasAnyRole(UserRoleType::SuperAdmin, UserRoleType::Admin)
            && !$targetUser->hasRole(UserRoleType::SuperAdmin)
        ) {
            return true;
        }
        return false;
    }
}
