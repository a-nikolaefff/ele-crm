<?php

namespace App\Models;

use App\Enums\UserRoleType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRole extends Model
{
    protected $table = 'user_roles';

    protected $fillable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    /**
     * Get a role by role type
     *
     * @param Builder      $query
     * @param UserRoleType $roleType The role type
     *
     * @return void
     */
    public function scopeGetRole(Builder $query, UserRoleType $roleType): void
    {
        $query->where('name', $roleType->value)->first();
    }

    /**
     * Get all roles except role given by type
     *
     * @param Builder $query
     * @param UserRoleType $roleType The role type
     *
     * @return void
     */
    public function scopeAllRolesExcept(Builder $query, UserRoleType $roleType): void
    {
        $query->where('name', '!=', $roleType->value);
    }
}
