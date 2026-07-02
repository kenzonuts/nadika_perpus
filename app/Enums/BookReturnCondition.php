<?php

namespace App\Enums;

enum BookReturnCondition: string
{
    case Good = 'good';
    case Damaged = 'damaged';
    case Lost = 'lost';
}
