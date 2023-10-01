<?php

    namespace App\Http\Controllers;

//    use App\Jobs\ApiGet;


use Illuminate\Support\Facades\Http;

class ApiGetAsynchronouslyController
    {
        public function __invoke() {


            $response = Http::withHeaders([
                "Authorization" => "auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT"
            ])->get('https://api.pexels.com/v1/search?query=people');

            foreach ($response['photos'] as $photo) {
                \App\Jobs\ApiGet::dispatch($photo['src']['tiny']);
            }

            return "test apiget";
        }
    }
