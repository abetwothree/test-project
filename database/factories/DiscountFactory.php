<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Discount::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'discount_percent' => $this->faker->randomFloat(2, 1, 99),
            'active' => $this->faker->boolean,
        ];
    }
}
