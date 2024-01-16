<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Brand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'image_path' => $this->faker->text(),
            'price' => $this->faker->numberBetween(1,999),
            // 'discount' => $this->faker->numberBetween(1,999),
            'quantity' => $this->faker->numberBetween(1,99),
            'description' => $this->faker->text(200),
            'target_sex' => $this->faker->randomElement([
                "male",
                "female",
                "both"
            ]),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
}
