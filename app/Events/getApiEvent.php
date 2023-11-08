<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class getApiEvent implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    public $imageSrc;

    /**
     * Create a new event instance.
     */
    public function __construct($imageUrl, $currentFolder)
    {
        $queuesArray = ['queue1', 'queue2', 'queue3'];
        $randomQueueIndex = array_rand($queuesArray);
        $this->onQueue($queuesArray[$randomQueueIndex]);

        $this->imageSrc = Http::withHeaders([
            'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT'
        ])->get($imageUrl);

        imagejpeg(imagecreatefromstring($this->imageSrc), $currentFolder . "/" . rand() . ".jpg");
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['asyncChannel'];
    }
}
