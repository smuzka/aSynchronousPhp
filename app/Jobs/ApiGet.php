<?php

namespace App\Jobs;

use App\Events\getApiEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ApiGet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $imageSrc;

    /**
     * Create a new job instance.
     */
    public function __construct($photoUrl)
    {
        $this->imageSrc = Http::withHeaders([
            'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT'
        ])->get($photoUrl);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        \App\Events\getApiEvent::dispatch($this->imageSrc);
        return 0;
    }
}
