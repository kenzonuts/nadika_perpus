<?php

declare(strict_types=1);

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterface;

final class DateFormatter
{
    public static function format(?CarbonInterface $date, string $format = 'd M Y'): ?string
    {
        if ($date === null) {
            return null;
        }

        return $date->format($format);
    }

    public static function formatDateTime(?CarbonInterface $date, string $format = 'd M Y H:i'): ?string
    {
        if ($date === null) {
            return null;
        }

        return $date->format($format);
    }

    public static function humanDiff(?CarbonInterface $date): ?string
    {
        if ($date === null) {
            return null;
        }

        return $date->diffForHumans();
    }

    public static function toIso8601(?CarbonInterface $date): ?string
    {
        if ($date === null) {
            return null;
        }

        return $date->toIso8601String();
    }

    public static function parse(?string $value): ?Carbon
    {
        if ($value === null || $value === '') {
            return null;
        }

        return Carbon::parse($value);
    }
}
