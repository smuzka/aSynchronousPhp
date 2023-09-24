<?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Route;



Route::get('/getApi', "App\\Http\\Controllers\\ApiGetController");
Route::get('/getApiSynchronously', "App\\Http\\Controllers\\ApiGetSynchronouslyController");
Route::get('/getApiPromises', "App\\Http\\Controllers\\ApiGetPromisesController");

Route::get('/', function () {

//    $addresses = DB::table('addresses')->count();
//    var_dump($addresses);

//    var_dump(\App\Models\Address::all());
//
//    \App\Models\Address::factory()->make();

    return view("welcome");
});
