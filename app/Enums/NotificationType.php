<?php

namespace App\Enums;

enum NotificationType: string
{
    case Borrow = 'borrow';
    case Return = 'return';
    case Overdue = 'overdue';
    case Fine = 'fine';
    case System = 'system';
    case Security = 'security';
}
