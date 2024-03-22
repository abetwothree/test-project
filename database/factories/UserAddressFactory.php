<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /** @var class-string<UserAddress> $model */
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_line1' => fake()->streetAddress(),
            'address_line2' => fake()->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'telephone' => fake()->phoneNumber(),
            'mobile' => fake()->phoneNumber(),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (UserAddress $userAddress) {
            $userAddress->user_id ??= User::factory()->create()->id;
        });
    }
}
