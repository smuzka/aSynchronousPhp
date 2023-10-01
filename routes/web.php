<?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Route;



Route::get('/getApiAsynchronously', "App\\Http\\Controllers\\ApiGetAsynchronouslyController");
Route::get('/getDBAsynchronously', "App\\Http\\Controllers\\DBGetAsynchronouslyController");


Route::get('/getApiSynchronously', "App\\Http\\Controllers\\ApiGetSynchronouslyController");
Route::get('/getDBSynchronously', "App\\Http\\Controllers\\DBGetSynchronouslyController");

Route::get('/', function () {
    return view("welcome");
});
