<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class getApiEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $imageSrc;

    /**
     * Create a new event instance.
     */
    public function __construct($imageSrc, $currentFolder)
    {
        $this->imageSrc = Http::withHeaders([
            'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT'
        ])->get($imageSrc);

        imagejpeg(imagecreatefromstring($this->imageSrc), $currentFolder . "/" . rand() . ".jpg");

        $this->imageSrc = $imageSrc;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['getApiChannel'];
    }
}
