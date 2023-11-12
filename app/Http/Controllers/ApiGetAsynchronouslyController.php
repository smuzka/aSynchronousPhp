<?php

    namespace App\Http\Controllers;

//    use App\Jobs\ApiGet;


use App\Events\getApiEvent;
use App\Jobs\ApiGet;
use App\Jobs\testJob;
use DateTime;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiGetAsynchronouslyController
    {
        public function __invoke() {

            $response = Http::withHeaders([
                "Authorization" => "auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT"
            ])->get('https://api.pexels.com/v1/search?query=people');

            $currentFolder = "async-" . now()->format("Y-m-d,H-m-s");
            File::makeDirectory($currentFolder);

            $jobs = [];
            foreach ($response['photos'] as $index => $photo) {
//                Log::info("loop iteration start: " . microtime());

//                Log::info("loop iteration end: " . microtime());
                \App\Events\getApiEvent::dispatch("test");

            }

            return "test apiget";
        }
    }
