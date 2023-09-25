<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstName' => fake()->name(),
            'lastName' => fake()->lastName(),
            'email' => fake()->email(),
            'addressId' => Address::factory(),
            'employeeId' => Employee::factory(),
        ];
    }
}
