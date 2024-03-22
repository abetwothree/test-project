<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\PaymentDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentDetail>
 */

class PaymentDetailFactory extends Factory
{
    /** @var class-string<PaymentDetail> $model */
    protected $model = PaymentDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 10, 500),
            'provider' => fake()->creditCardType(),
            'status' => fake()->randomElement(['pending', 'completed', 'refunded', 'declined']),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (PaymentDetail $paymentDetail) {
            $paymentDetail->order_id ??= OrderDetail::factory()->create()->id;
        });
    }
}
