<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Discount;
use App\Models\OrderDetail;
use App\Models\OrderItem;
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
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userCount = 10;
        $this->command->info('Starting seeding product categories and products...');

        // this will seed products with category, inventory, and discount because of the afterMaking method in the ProductFactory
        Product::factory(10)->create();

        $orders = OrderItem::factory(fake()->numberBetween(5, 20))
            ->has(OrderDetail::factory(), 'order')->create();

        /**
         * this section below will seed the same as above, but explicitly setting the relationships
         * it's also seeding other relationships to link the products and orders to a user
         */
        for ($i = 0; $i < $userCount; $i++) {
            $user = User::factory()
                ->has(UserAddress::factory()->count(fake()->numberBetween(2, 5)), 'addresses')
                ->has(UserPayment::factory()->count(fake()->numberBetween(2, 5)), 'payments')
                ->create();

            // create a shopping session for each user
            $session = ShoppingSession::factory()
                ->for($user, 'user')
                ->create();

            Product::factory()
                ->for(ProductCategory::factory(), 'category')
                ->for(ProductInventory::factory(), 'inventory')
                ->for(Discount::factory(), 'discount')
                ->has(
                    OrderItem::factory(fake()->numberBetween(2, 5))
                        ->has(OrderDetail::factory(), 'order'),
                    'orderItems'
                )
                ->has(
                    // attach the session to the cart items
                    CartItem::factory(fake()->numberBetween(2, 5))
                        ->for($session, 'shoppingSession'),
                    'cartItems'
                )
                ->count(5)
                ->create();
        }

        $this->command->info('Finished seeding product categories and products');
    }
}
