<?php

namespace App\Models;

use App\Enums\UserRoleType;
use App\Models\Traits\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'name',
            'email',
            'password',
            'role_id',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function scopeSort(
        Builder $query,
        array $queryParams,
    ): void {
        $sortColumn = $queryParams['sort'] ?? '';
        $sortDirection = $queryParams['direction'] ?? 'asc';
        $query->when(
            !empty($sortColumn),
            function ($query) use ($sortColumn, $sortDirection) {
                return $query->orderBy($sortColumn, $sortDirection);
            }
        );
    }

    /**
     * Check if the user has this role
     *
     * @param UserRoleType $roleType The role to check if the user has it
     *
     * @return bool
     */
    public function hasRole(UserRoleType $roleType): bool
    {
        $userRoleName = $this->role->name;
        return $userRoleName === $roleType->value;
    }

    /**
     * Check if the user has any of the roles
     *
     * @param UserRoleType ...$roleTypes The roles to check if the user has any of them
     *
     * @return bool
     */
    public function hasAnyRole(UserRoleType ...$roleTypes): bool
    {
        $userRoleName = $this->role->name;
        foreach ($roleTypes as $roleType) {
            if ($userRoleName === $roleType->value) {
                return true;
            }
        }
        return false;
    }
}
