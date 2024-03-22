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
    /** @var class-string<UserPayment> $model */
    protected $model = UserPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_type' => fake()->randomElement(['credit_card', 'debit_card', 'paypal']),
            'provider' => fake()->company(),
            'account_number' => fake()->iban(),
            'expiry_date' => fake()->creditCardExpirationDateString(),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (UserPayment $userPayment) {
            $userPayment->user_id ??= User::inRandomOrder()->first()->id ?? User::factory()->create()->id;
        });
    }
}
