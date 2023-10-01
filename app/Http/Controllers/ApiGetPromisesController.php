<?php

    namespace App\Http\Controllers;

//    use App\Jobs\ApiGet;


use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiGetPromisesController
    {
        public function __invoke() {


            $response = Http::withHeaders([
                "Authorization" => "auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT"
            ])->get('https://api.pexels.com/v1/search?query=people');


            $imagesArray = [];

            foreach ($response['photos'] as $photo) {
                $imagesArray []= $photo;
                $promise = new Promise();
                $promise
                    ->then(function ($image) use ($imagesArray) {
                        $imagesArray []= $image;
                        return $image;
                    })
                    ->then(function () use ($imagesArray) {
                        $imagesArray []= "image couldn't be fetched";
                    });

                $promise->resolve(
                    Http::withHeaders([
                        'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT'
                    ])->get($photo['src']['original']));

//                $images []= Http::withHeaders([
//                    'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT'
//                ])->get($photo['src']['original']);
            }

            return $imagesArray;
        }
    }
