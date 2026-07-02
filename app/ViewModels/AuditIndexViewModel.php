<?php

declare(strict_types=1);

namespace App\ViewModels;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class AuditIndexViewModel
{
    public function __construct(private readonly LengthAwarePaginator $logs) {}

    public function toArray(): array
    {
        return [
            'auditLogs' => collect($this->logs->items())->map(fn ($log): array => [
                'id' => (string) $log->id,
                'action' => $log->event ?? 'updated',
                'user' => $log->causer?->name ?? 'System',
                'email' => $log->causer?->email ?? '-',
                'description' => $log->description,
                'timestamp' => $log->created_at?->format('d M Y H:i') ?? '-',
                'relative' => $log->created_at?->diffForHumans() ?? '-',
                'severity' => 'info',
                'ip' => $log->properties['ip'] ?? '-',
                'browser' => $log->properties['browser'] ?? '-',
                'device' => $log->properties['device'] ?? '-',
            ])->all(),
            'severityVariants' => ['info' => 'neutral', 'warning' => 'warning', 'error' => 'danger'],
        ];
    }
}
