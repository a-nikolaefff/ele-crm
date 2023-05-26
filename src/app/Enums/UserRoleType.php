<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * List of roles used in the app. Values are names of roles in the database.
 */
enum UserRoleType: string
{
    case SuperAdmin = "главный администратор";
    case Admin = "администратор";
    case Employee = "сотрудник";
    case Stranger = "неизвестный";
}
