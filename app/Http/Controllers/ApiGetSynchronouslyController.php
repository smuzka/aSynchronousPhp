<?php

    namespace App\Http\Controllers;

//    use App\Jobs\ApiGet;


use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\ErrorHandler\Debug;

class ApiGetSynchronouslyController
    {
        public function __invoke() {


            $response = Http::withHeaders([
                "Authorization" => "auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT"
            ])->get('https://api.pexels.com/v1/search?query=people');

            $client = new Client();
            $headers = [
                'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT',
            ];

            $images = [];

            $currentFolder = "sync-" . now();

            File::makeDirectory($currentFolder);

            foreach ($response['photos'] as $index => $photo) {
                $images[] = Http::withHeaders([
                    'Authorization' => 'auZTe7rY3pgsoz3IiF4NkuiCllqhmfJE6OeGqzDDqISsmMjWINUN3gJT'
                ])->get($photo['src']['original']);

                imagejpeg(imagecreatefromstring($images[count($images) - 1]), $currentFolder . "/" . $index . ".jpg");

            }





//            Storage::disk('public')->put("test", $img);



            return $images;
        }
    }
