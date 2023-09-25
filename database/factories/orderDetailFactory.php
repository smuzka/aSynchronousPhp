<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Office;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class orderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

//        return [
//            'quantity' => fake()->numberBetween(1, 10),
//            'orderId' => Order::factory(),
//            'productId' => Product::factory(),
//        ];

        $createNewOrderRandom = rand(0, 1000) / 1000;
        if (DB::table('offices')->count() === 0) {
            $createNewOrderRandom = 0;
        }

        if ($createNewOrderRandom < 0.1) {
            return [
                'quantity' => fake()->numberBetween(1, 10),
                'productId' => Product::factory(),
                'orderId' => Order::factory(),
            ];
        } else {
            return [
                'quantity' => fake()->numberBetween(1, 10),
                'productId' => Product::factory(),
                'orderId' => function () {
                    return DB::table('orders')->orderBy('id', 'desc')->first()->id;
                },
            ];
        }
    }
}
