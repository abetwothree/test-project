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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = OrderDetail::class;
    public function definition(): array
    {
        return [
        'user_id' => User::all()->isEmpty() ? User::factory()->create()->id : User::all()->random()->id,
        'payment_id'=> PaymentDetail::all()->isEmpty() ? PaymentDetail::factory()->create()->id : PaymentDetail::all()->random()->id,
            'total' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
