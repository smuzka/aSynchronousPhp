<?php

use Illuminate\Support\Facades\Route;



Route::get('/getApi', "App\\Http\\Controllers\\ApiGetController");

Route::get('/', function () {
    return view("welcome");
});
