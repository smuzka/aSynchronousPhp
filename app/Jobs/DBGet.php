<?php

namespace App\Jobs;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DBGet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queryResult;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $queuesArray = ['queue1', 'queue2', 'queue3'];
        $randomQueueIndex = array_rand($queuesArray);
        $this->onQueue($queuesArray[$randomQueueIndex]);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->queryResult = DB::query()
            ->select('employees.firstName as first name', 'customers.id', DB::raw('sum(products.price * order_details.quantity) as price'))
            ->from('employees')
            ->join('customers', 'employees.id' , '=', 'customers.employeeId')
            ->join('orders', 'customers.id', '=', 'orders.customerId')
            ->join('order_details', 'orders.id', '=', 'order_details.orderId')
            ->join('products', "order_details.productId", "products.id")
            ->groupBy('employees.id')
            ->having(DB::raw('sum(products.price * order_details.quantity)'), '>', 44000)
            ->get();

        \App\Events\getDBEvent::dispatch($this->queryResult);
        return 0;
    }
}
