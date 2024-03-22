<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /** @var class-string<OrderItem> $model */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 5),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (OrderItem $orderItem) {
            $orderItem->order_id ??= OrderDetail::factory()->create()->id;
            $orderItem->product_id ??= Product::factory()->create()->id;
        });
    }
}
