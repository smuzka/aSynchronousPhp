<?php

    namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DBGetAsynchronouslyController
    {
        public function __invoke() {

            for ($i = 0; $i < 10; $i += 1) {
                \App\Jobs\DBGet::dispatch();
            }

            return 0;
        }
    }
