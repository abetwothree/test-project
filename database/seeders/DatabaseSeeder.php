<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Discount;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use App\Models\ShoppingSession;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserPayment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $userCount = 3;

        $this->command->info('Starting seeding product categories and products...');

        // this will seed products with category, inventory, and discount because of the afterMaking method in the ProductFactory
        Product::factory(3)->create();

        for ($i = 0; $i < $userCount; $i++) {
            $user = User::factory()
                ->has(UserAddress::factory()->count(fake()->numberBetween(1, 3)), 'addresses')
                ->has(UserPayment::factory()->count(fake()->numberBetween(1, 3)), 'payments')
                ->create();

            // create a shopping session for each user
            $session = ShoppingSession::factory()
                ->for($user, 'user')
                ->create();

            // create products with associated order items, cart items, and details
            Product::factory()
                ->for(ProductCategory::factory(), 'category')
                ->for(ProductInventory::factory(), 'inventory')
                ->for(Discount::factory(), 'discount')
                ->has(
                    OrderItem::factory(fake()->numberBetween(1, 3))
                        ->has(OrderDetail::factory()->has(PaymentDetail::factory()), 'order'),
                    'orderItems'
                )
                ->has(
                    // attach the session to the cart items
                    CartItem::factory(fake()->numberBetween(1, 3))
                        ->for($session, 'shoppingSession'),
                    'cartItems'
                )
                ->count(2)
                ->create();
        }
    }
}
