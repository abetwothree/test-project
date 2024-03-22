<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\ShoppingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /** @var class-string<CartItem> */
    protected $model = CartItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 10),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (CartItem $cartItem) {
            $cartItem->session_id ??= ShoppingSession::factory()->create()->id;
            $cartItem->product_id ??= Product::factory()->create()->id;
        });
    }
}
