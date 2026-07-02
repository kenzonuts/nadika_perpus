<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class SendNotification
{
    /**
     * @param  object  $event
     */
    public function handle(object $event): void
    {
        Log::channel('system')->debug('SendNotification listener stub invoked', [
            'event' => $event::class,
        ]);
    }
}
