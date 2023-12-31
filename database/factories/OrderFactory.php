<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_price' => $this->faker->numberBetween(1,9999999999),
            'status' => $this->faker->randomElement([
                "pendingOrder",
                "done",
                "canceled"
            ]),
            'client_id' => Client::factory(),
        ];
    }
}
