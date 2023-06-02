<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Models\CustomerType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(UserRoleEnum::SuperAdmin, UserRoleEnum::Admin);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(UserRoleEnum::SuperAdmin);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CustomerType $customerType): bool
    {
        return $user->hasRole(UserRoleEnum::SuperAdmin)
            && !$customerType->is_base_type;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CustomerType $customerType): bool
    {
        return $user->hasRole(UserRoleEnum::SuperAdmin)
            && !$customerType->is_base_type;
    }
}
