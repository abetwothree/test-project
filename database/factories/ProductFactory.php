<?php

namespace Database\Factories;

use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

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

    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'SKU' => $this->faker->unique()->bothify('???-########'),
            'category_id' => ProductCategory::factory(),
            'inventory_id' => ProductInventory::factory(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'discount_id' => Discount::factory(),
        ];
    }
}
