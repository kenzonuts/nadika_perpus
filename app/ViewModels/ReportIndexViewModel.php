<?php

declare(strict_types=1);

namespace App\ViewModels;

final class ReportIndexViewModel
{
    public function __construct(private readonly array $payload, private readonly array $statCards = []) {}

    public function toArray(): array
    {
        return [
            'overviewStats' => [
                ['title' => 'Books', 'value' => (string) count($this->payload['bookReports'] ?? []), 'icon' => 'book-open', 'trend' => '0%', 'trendUp' => true, 'color' => 'primary'],
                ['title' => 'Members', 'value' => (string) count($this->payload['memberReports'] ?? []), 'icon' => 'users', 'trend' => '0%', 'trendUp' => true, 'color' => 'success'],
            ],
            'statCards' => $this->statCards,
            'bookReports' => $this->payload['bookReports'] ?? [],
            'memberReports' => $this->payload['memberReports'] ?? [],
            'borrowingReports' => $this->payload['borrowingReports'] ?? [],
            'fineReports' => $this->payload['fineReports'] ?? [],
        ];
    }
}
