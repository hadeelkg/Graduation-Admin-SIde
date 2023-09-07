<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order_product>
 */
class order_productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_price' => $this->faker->numberBetween(1,999),
            'quantity' => $this->faker->numberBetween(1,99),
            'subtotal_price' => $this->faker->numberBetween(1,9999999999),
            'product_id' => Product::factory(), 
            'order_id' => Order::factory(), 
        ];
    }
}
