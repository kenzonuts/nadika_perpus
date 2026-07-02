<?php

declare(strict_types=1);

namespace App\ViewModels;

final class DashboardViewModel
{
    public function __construct(private readonly array $payload) {}

    public function toArray(): array
    {
        return [
            'overviewStats' => [
                ['title' => 'Books', 'value' => (string) ($this->payload['stats']['books'] ?? 0), 'icon' => 'book-open', 'trend' => '+0%', 'trendUp' => true, 'color' => 'primary'],
                ['title' => 'Members', 'value' => (string) ($this->payload['stats']['members'] ?? 0), 'icon' => 'users', 'trend' => '+0%', 'trendUp' => true, 'color' => 'success'],
                ['title' => 'Active Loans', 'value' => (string) ($this->payload['stats']['active_borrowings'] ?? 0), 'icon' => 'clock', 'trend' => '0%', 'trendUp' => true, 'color' => 'warning'],
                ['title' => 'Unpaid Fines', 'value' => '$'.number_format((float) ($this->payload['stats']['unpaid_fines'] ?? 0), 2), 'icon' => 'currency-dollar', 'trend' => '0%', 'trendUp' => false, 'color' => 'danger'],
            ],
            'bookReports' => $this->payload['popularBooks'] ?? [],
            'borrowingReports' => $this->payload['recentBorrowings'] ?? [],
        ];
    }
}
