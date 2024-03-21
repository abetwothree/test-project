<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPayment>
 */
class UserPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserPayment::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'payment_type' => $this->faker->randomElement(['credit_card', 'debit_card', 'paypal']),
            'provider' => $this->faker->company,
            'account_number' => $this->faker->bankAccountNumber,
            'expiry_date' => $this->faker->creditCardExpirationDateString,
        ];
    }
}
