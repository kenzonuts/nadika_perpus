<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AuditService;
use App\ViewModels\AuditIndexViewModel;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;

class AuditController extends Controller
{
    public function index(AuditService $service): View
    {
        $logs = $service->paginate();

        return view('audit.index', (new AuditIndexViewModel($logs))->toArray());
    }

    public function show(string $id): View
    {
        $log = Activity::query()->with('causer')->findOrFail($id);

        return view('audit.show', [
            'auditLogs' => [[
                'id' => (string) $log->id,
                'action' => $log->event ?? 'updated',
                'user' => $log->causer?->name ?? 'System',
                'email' => $log->causer?->email ?? '-',
                'description' => $log->description,
                'timestamp' => $log->created_at?->format('d M Y H:i') ?? '-',
                'severity' => 'info',
                'ip' => $log->properties['ip'] ?? '-',
                'browser' => $log->properties['browser'] ?? '-',
                'device' => $log->properties['device'] ?? '-',
            ]],
            'severityVariants' => ['info' => 'neutral', 'warning' => 'warning', 'error' => 'danger'],
        ]);
    }
}
