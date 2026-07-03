<?php

declare(strict_types=1);

namespace App\ViewModels;

final class DashboardViewModel
{
    public function __construct(private readonly array $payload) {}

    public function toArray(): array
    {
        $stats = $this->payload['stats'] ?? [];

        return [
            'overviewStats' => [
                ['title' => 'Total Books', 'value' => number_format((int) ($stats['books'] ?? 0)), 'icon' => 'book-open', 'trend' => '0%', 'trendUp' => true, 'color' => 'primary'],
                ['title' => 'Total Members', 'value' => number_format((int) ($stats['members'] ?? 0)), 'icon' => 'users', 'trend' => '0%', 'trendUp' => true, 'color' => 'success'],
                ['title' => 'Borrowed Books', 'value' => number_format((int) ($stats['active_borrowings'] ?? 0)), 'icon' => 'arrow-right-circle', 'trend' => '0%', 'trendUp' => false, 'color' => 'warning'],
                ['title' => 'Late Returns', 'value' => number_format((int) ($stats['overdue_borrowings'] ?? 0)), 'icon' => 'exclamation-triangle', 'trend' => '0%', 'trendUp' => false, 'color' => 'danger'],
            ],
            'bookReports' => $this->payload['popularBooks'] ?? [],
            'borrowingReports' => $this->payload['recentBorrowings'] ?? [],
            'recentActivity' => $this->payload['recentActivity'] ?? [],
        ];
    }
}
