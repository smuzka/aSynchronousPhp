<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ApiGetAsynchronouslyController
{
    public function __invoke()
    {

        $response = Http::withHeaders([
            "Authorization" => getenv("PEXELS_API_KEY")
        ])->get('https://api.pexels.com/v1/search?query=people');

        $currentFolder = "async-" . now()->format("Y-m-d,H-m-s");
        File::makeDirectory($currentFolder);

        foreach ($response['photos'] as $index => $photo) {
            \App\Jobs\ApiGet::dispatch($photo['src']['original'], $currentFolder, $index);
        }

        return "Ok";
    }
}
