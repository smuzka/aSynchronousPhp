<?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Route;



Route::get('/getApi', "App\\Http\\Controllers\\ApiGetController");
Route::get('/getApiSynchronously', "App\\Http\\Controllers\\ApiGetSynchronouslyController");


Route::get('/getDBSynchronously', "App\\Http\\Controllers\\DBGetSynchronouslyController");

Route::get('/', function () {

    $result = DB::query()
        ->select('employees.firstName as first name', 'employees.lastName as last name', DB::raw('sum(order_details.quantity) as quantity'))
        ->from('employees')
        ->join('customers', 'employees.id' , '=', 'customers.employeeId')
        ->join('orders', 'customers.id', '=', 'orders.customerId')
        ->join('order_details', 'orders.id', '=', 'order_details.orderId')
        ->groupBy('employees.id')
        ->having(DB::raw('sum(order_details.quantity)'), '>', 340)
        ->get();

    foreach ($result as $order) {
        var_dump($order);
        echo "<br/>";
        echo "<br/>";
    }

    return view("welcome");
});
