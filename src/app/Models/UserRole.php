<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRole extends Model
{
    public const SUPER_ADMIN_ROLE = 'главный администратор';
    public const ADMIN_ROLE = 'администратор';
    public const EMPLOYEE_ROLE = 'сотрудник';
    public const STRANGER_ROLE = 'неизвестный';

    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public static function getAllExceptSuperAdmin()
    {
        return self::where('name', '!=', UserRole::SUPER_ADMIN_ROLE)
            ->get();
    }

    public static function getSuperAdmin()
    {
        return self::where('name', '=', UserRole::SUPER_ADMIN_ROLE)
            ->get();
    }

    public static function isSuperAdminRoleId(int $id): bool
    {
        return UserRole::find($id)->name === UserRole::SUPER_ADMIN_ROLE;
    }
}
