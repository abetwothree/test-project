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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PaymentDetail::class;
    public function definition(): array
    {
        return [
            'order_id' => OrderDetail::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'provider' => $this->faker->randomElement(['Visa', 'MasterCard', 'PayPal']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'refunded', 'declined']),
        ];
    }
}
