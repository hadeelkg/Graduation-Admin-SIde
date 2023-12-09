<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\prescription_order>
 */
class prescription_orderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'image_path' => $this->faker->text(),
            'status' => $this->faker->randomElement([
                "pendingOrder",
                "done",
                "canceled"
            ]),
        ];
    }
}
