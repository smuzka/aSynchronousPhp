<?php

namespace App\Http\Controllers;

//    use App\Jobs\ApiGet;


use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiGetPromisesController
{
    public function __invoke()
    {
        $responseWithImagesLinks = Http::withHeaders([
            "Authorization" => getenv("PEXELS_API_KEY")
        ])->get('https://api.pexels.com/v1/search?query=people');

        $requestPromises = [];

        $currentFolder = "promises-" . now();
        File::makeDirectory($currentFolder);

        foreach ($responseWithImagesLinks['photos'] as $index => $photo) {
            $promise = Http::async()->get($photo['src']['original'])->then(function ($response) use ($currentFolder, $index) {
                Log::info($index);
                Log::info(date("Y-m-d, h:i:s", time()));
                imagejpeg(imagecreatefromstring($response), $currentFolder . "/" . $index . ".jpg");
                \App\Events\promisesMessageEvent::dispatch("Ok");
            });

            $requestPromises[] = $promise;
        }

        Utils::all($requestPromises)
            ->wait();

        return ["ok"];
    }

    public function __invoke_file_saving()
    {

        $currentFolder = "promises-" . now();
        File::makeDirectory($currentFolder);

        $responseWithImagesLinks = Http::withHeaders([
            "Authorization" => "auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT"
        ])->get('https://api.pexels.com/v1/search?query=people');
        $image = null;
        $promises = [];


        $imagePromise = Http::async()->get($responseWithImagesLinks['photos'][0]['src']['original'])->then(function ($response) use ($image, $currentFolder, $promises) {
            return $response;
        });

//        $milliseconds = floor(microtime(true) * 1000);
//        Log::info($milliseconds);
        $image = $imagePromise->wait();

        for ($i = 0; $i < 15; $i++) {
            $newPromise = new Promise();
            $newPromise
                ->then(
                    function () use ($image, $currentFolder, $i) {
                        imagejpeg(imagecreatefromstring($image), $currentFolder . "/" . $i . ".jpg");
                        $milliseconds = floor(microtime(true) * 1000);
                        Log::info($milliseconds);
                        return $i;
                    }
                )
                ->then(
                    function ($i) {
//                        Log::info("success");
                        Log::info("success - " . $i);
//                        $milliseconds = floor(microtime(true) * 1000);
//                        Log::info($milliseconds);
                    },
                    function () {
                        Log::info("fail");
                    }
                );

            $newPromise->resolve("resolve");

            $promises[] = $newPromise;
        }

        $milliseconds = floor(microtime(true) * 1000);
        Log::info("start");
        Log::info($milliseconds);
        $images = Utils::all($promises)
            ->wait();
        $milliseconds = floor(microtime(true) * 1000);
        Log::info($milliseconds);
        Log::info("end");
//        $images = Utils::all($requestPromises)
//            ->wait();

        return ["ok"];
    }
}
