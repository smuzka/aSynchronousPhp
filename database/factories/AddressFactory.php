<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => fake()->city(),
            'street' => fake()->streetAddress(),
            'houseNumber' => fake()->buildingNumber(),
            'postCode' => fake()->numberBetween(10, 99) . '-' . fake()->numberBetween(100, 999),
        ];
    }
}
