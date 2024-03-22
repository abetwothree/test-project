<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\OrderDetail;
use App\Models\PaymentDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /** @var class-string<OrderDetail> $model */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => fake()->randomFloat(2, 10, 500),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (OrderDetail $orderDetail) {
            $orderDetail->user_id ??= User::inRandomOrder()->first()->id ?? User::factory()->create()->id;
            $orderDetail->payment_id ??= PaymentDetail::inRandomOrder()->first()->id ?? PaymentDetail::factory()->create()->id;
        });
    }
}
