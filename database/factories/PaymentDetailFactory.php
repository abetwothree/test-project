<?php

namespace Database\Factories;

use App\Models\PaymentDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentDetail>
 */
class PaymentDetailFactory extends Factory
{
    /** @var class-string<PaymentDetail> */
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
            'provider' => fake()->randomElement(['MC', 'AMEX', 'VISA', 'DISCOVER']),
            'status' => fake()->randomElement(['pending', 'completed', 'refunded', 'declined']),
        ];
    }
}
