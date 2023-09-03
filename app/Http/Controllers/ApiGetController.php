<?php

    namespace App\Http\Controllers;

//    use App\Jobs\ApiGet;


class ApiGetController
    {
        public function __invoke() {

            \App\Jobs\ApiGet::dispatch();
//            \App\Events\getApi::dispatch();

            return "test apiget";
        }
    }
