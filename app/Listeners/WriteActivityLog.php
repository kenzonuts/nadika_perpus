<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class WriteActivityLog
{
    /**
     * @param  object  $event
     */
    public function handle(object $event): void
    {
        $payload = [
            'event' => $event::class,
            'timestamp' => now()->toIso8601String(),
        ];

        if (property_exists($event, 'book')) {
            $payload['subject_id'] = $event->book->getKey();
            $payload['subject_type'] = $event->book::class;
        } elseif (property_exists($event, 'member')) {
            $payload['subject_id'] = $event->member->getKey();
            $payload['subject_type'] = $event->member::class;
        } elseif (property_exists($event, 'borrowing')) {
            $payload['subject_id'] = $event->borrowing->getKey();
            $payload['subject_type'] = $event->borrowing::class;
        } elseif (property_exists($event, 'bookReturn')) {
            $payload['subject_id'] = $event->bookReturn->getKey();
            $payload['subject_type'] = $event->bookReturn::class;
        } elseif (property_exists($event, 'fine')) {
            $payload['subject_id'] = $event->fine->getKey();
            $payload['subject_type'] = $event->fine::class;
        }

        Log::channel('activity')->info('Domain event recorded', $payload);
    }
}
