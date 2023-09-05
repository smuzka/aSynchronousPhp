<?php

use Illuminate\Support\Facades\Route;



Route::get('/getApi', "App\\Http\\Controllers\\ApiGetController");
Route::get('/getApiSynchronously', "App\\Http\\Controllers\\ApiGetSynchronouslyController");

Route::get('/', function () {
    return view("welcome");
});
