<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DBGetSynchronouslyController
{
    public function __invoke()
    {

        $result = [];
        for ($i = 0; $i < 10; $i += 1) {
            $result [] = DB::query()
                ->select('employees.firstName as first name', 'customers.id', DB::raw('sum(products.price * order_details.quantity) as price'))
                ->from('employees')
                ->join('customers', 'employees.id', '=', 'customers.employeeId')
                ->join('orders', 'customers.id', '=', 'orders.customerId')
                ->join('order_details', 'orders.id', '=', 'order_details.orderId')
                ->join('products', "order_details.productId", "products.id")
                ->groupBy('employees.id')
                ->having(DB::raw('sum(products.price * order_details.quantity)'), '>', 40000)
                ->get();
            \App\Events\getDBSyncEvent::dispatch("Ok");
        }

        return $result;
    }
}
