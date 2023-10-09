<?php

    namespace App\Http\Controllers;

//    use App\Jobs\ApiGet;

use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use http\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DBGetPromisesController
    {
        public function __invoke() {

            $imagesUrlsArray = Http::withHeaders([
                "Authorization" => "auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT"
            ])->get('https://api.pexels.com/v1/search?query=people');

            $promisesArray = [];
            $imagesArray = [];
            $client = new \GuzzleHttp\Client();

            foreach ($imagesUrlsArray['photos'] as $imageUrl) {
                $request = new Request('GET', $imageUrl['src']['original']);
                $promisesArray []= $client->sendAsync($request)
                    ->then(function($response) use ($imagesArray) {
                        $imagesArray []= $response->getBody();
                        Log::info(last($imagesArray));
                    });
            }

            $responses = Promise\Utils::settle($promisesArray)->wait();

            return $imagesArray;
        }
    }
