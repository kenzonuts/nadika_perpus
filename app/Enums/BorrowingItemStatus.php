<?php

namespace App\Enums;

enum BorrowingItemStatus: string
{
    case Borrowed = 'borrowed';
    case Returned = 'returned';
    case Overdue = 'overdue';
}
