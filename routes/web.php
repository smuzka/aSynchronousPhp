<?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Route;



Route::get('/getApiAsynchronously', "App\\Http\\Controllers\\ApiGetAsynchronouslyController");
Route::get('/getDBAsynchronously', "App\\Http\\Controllers\\DBGetAsynchronouslyController");
Route::get('/getMailAsynchronously', "App\\Http\\Controllers\\MailGetAsynchronouslyController");


Route::get('/getApiSynchronously', "App\\Http\\Controllers\\ApiGetSynchronouslyController");
Route::get('/getDBSynchronously', "App\\Http\\Controllers\\DBGetSynchronouslyController");
Route::get('/getMailSynchronously', "App\\Http\\Controllers\\MailGetSynchronouslyController");

Route::get('/getApiPromises', "App\\Http\\Controllers\\ApiGetPromisesController");


Route::get('/', function () {
    return view("welcome");
});
