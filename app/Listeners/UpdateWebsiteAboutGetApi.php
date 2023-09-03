<?php

namespace App\Listeners;

use App\Events\getApiEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateWebsiteAboutGetApi
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(getApiEvent $event): void
    {
        info("log Test");
    }
}
