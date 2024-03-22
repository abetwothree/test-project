<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ShoppingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingSession>
 */
class ShoppingSessionFactory extends Factory
{
    /** @var class-string<ShoppingSession> $model */
    protected $model = ShoppingSession::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => fake()->randomFloat(2, 10, 5000),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (ShoppingSession $shoppingSession) {
            $shoppingSession->user_id ??= User::factory()->create()->id;
        });
    }
}
