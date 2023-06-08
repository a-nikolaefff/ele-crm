<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * List of statuses of request used in the app. Values are names of statuses in the database.
 */
enum RequestStatusEnum: string
{
    case New = 'новая';
    case AwaitingResponse = 'уточнение';
    case InProgress = 'в работе';
    case Completed = 'ответ отправлен';
    case Cancelled = 'отменена';

    case Success = 'заказ получен';
}
