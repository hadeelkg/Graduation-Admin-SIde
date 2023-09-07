<?php

namespace Database\Factories;

// use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'gender' => $this->faker->randomElement([
                "male",
                "female",
            ]),
            'phone' => '09' . fake()->randomElement(['1', '2']) . fake()->randomNumber(7, true),
            'address' => $this->faker->address(),
            "city_id" => City::factory(),
        ];
    }
}
