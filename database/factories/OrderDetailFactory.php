<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\PaymentDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /** @var class-string<OrderDetail> */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // This will be set when creating the OrderDetail
            // This will be set after creating PaymentDetail
            'total' => fake()->randomFloat(2, 10, 500),
        ];
    }
}
