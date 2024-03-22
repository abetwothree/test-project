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
    /** @var class-string<Product> $model */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'desc' => fake()->sentence(),
            'SKU' => fake()->unique()->bothify('???-########'),
            'price' => fake()->randomFloat(2, 1, 1000),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Product $product) {
            $product->category_id ??= ProductCategory::factory()->create()->id;
            $product->inventory_id ??= ProductInventory::factory()->create()->id;
            $product->discount_id ??= Discount::factory()->create()->id;
        });
    }
}
