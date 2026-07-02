<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class UpdateStatistics
{
    /**
     * @param  object  $event
     */
    public function handle(object $event): void
    {
        Log::channel('system')->debug('UpdateStatistics listener stub invoked', [
            'event' => $event::class,
        ]);
    }
}
