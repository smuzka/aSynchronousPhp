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

    public $message;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        info("__constructor job log");
        $this->message = "test api get job";
    }

    /**
     * Execute the job.
     */
    public function handle(): string
    {
        info("handle job log");
//        \App\Events\getApiEvent::dispatch();

        event(new getApiEvent());

//        $response = Http::get("api.coincap.io/v2/assets");
//        event(new getApi());
//            return $response->json();
        return $this->message;
    }
}
