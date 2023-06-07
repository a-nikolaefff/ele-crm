<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * List of base customer types used in the app. Values are names of customer types in the database.
 */
enum BaseCustomerTypeEnum: string
{
    case ProjectOrganization = 'проектная организация';
}
