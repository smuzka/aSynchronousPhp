<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createNewOfficeRandom = rand(0, 1000) / 1000;
        if (DB::table('offices')->count() === 0) {
            $createNewOfficeRandom = 0;
        }


        if ($createNewOfficeRandom < 0.1) {
            return [
                'firstName' => fake()->firstName(),
                'lastName' => fake()->lastName(),
                'email' => fake()->email(),
                'jobTitle' => fake()->jobTitle(),
                'addressId' => Address::factory(),
                'officeId' => Office::factory(),
            ];
        } else {
            return [
                'firstName' => fake()->firstName(),
                'lastName' => fake()->lastName(),
                'email' => fake()->email(),
                'jobTitle' => fake()->jobTitle(),
                'addressId' => Address::factory(),
                'officeId' => function () {
                    return DB::table('offices')->orderBy('id', 'desc')->first()->id;
                },
            ];
        }
    }
}
