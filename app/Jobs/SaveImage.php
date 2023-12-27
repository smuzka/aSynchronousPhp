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

class SaveImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $image;
    public $currentFolder;
    public $index;
    /**
     * Create a new job instance.
     */
    public function __construct($image, $currentFolder, $index)
    {
        $this->image = $image;
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
        $myfile = fopen(public_path() . "/" . $this->currentFolder . "/" . $this->index . ".jpg", "w");
//        imagejpeg(imagecreatefromstring($this->image), public_path() . "/" . $this->currentFolder . "/" . $this->index . ".jpg");
        \App\Events\promisesMessageEvent::dispatch("Got this");

        return 0;
    }
}
