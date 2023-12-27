<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Http;

    class ApiGetSynchronouslyController
    {
        public function __invoke() {

            $imagesUrls = Http::withHeaders([
                "Authorization" => getenv("PEXELS_API_KEY")
            ])->get('https://api.pexels.com/v1/search?query=people');

            $images = [];

            $currentFolder = "sync-" . now();

            File::makeDirectory($currentFolder);

            foreach ($imagesUrls['photos'] as $index => $photo) {
                $images[] = Http::withHeaders([
                    'Authorization' => getenv("PEXELS_API_KEY")
                ])->get($photo['src']['original']);

                imagejpeg(imagecreatefromstring($images[count($images) - 1]), $currentFolder . "/" . $index . ".jpg");

                \App\Events\sendMessageEvent::dispatch("Image downloaded");
            }

            return $images;
        }
    }
