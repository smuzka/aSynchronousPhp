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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiGet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $imageUrl;
    public $currentFolder;
    public $index;
    /**
     * Create a new job instance.
     */
    public function __construct($imageUrl, $currentFolder, $index)
    {
        $this->imageUrl = $imageUrl;
        $this->currentFolder = $currentFolder;
        $this->index = $index;

        $queuesArray = ['queue1', 'queue2', 'queue3'];
        $randomQueueIndex = array_rand($queuesArray);
        $this->onQueue($queuesArray[$randomQueueIndex]);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $imageSrc = Http::withHeaders([
            'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT'
        ])->get($this->imageUrl);

        imagejpeg(imagecreatefromstring($imageSrc), public_path() . "/" . $this->currentFolder . "/" . $this->index . ".jpg");

        \App\Events\getApiEvent::dispatch("test");

        return 0;
    }
}
