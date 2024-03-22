<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Discount;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserPayment;
use App\Models\ShoppingSession;
use App\Models\CartItem;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\PaymentDetail;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting seeding product categories and products...');

        // this will seed products with category, inventory, and discount because of the afterMaking method in the ProductFactory
        Product::factory(10)->create();


        // something is off with OrderItem that it won't seed properly
        // $orders = OrderItem::factory(fake()->numberBetween(5, 20))
        //             ->has(OrderDetail::factory(), 'order')->create();

        /**
         * this section below will seed the same as above, but explicitly setting the relationships
         * it's also seeding other relationships to link the products and orders to a user
         */

        $user = User::factory()
            ->has(UserAddress::factory()->count(fake()->numberBetween(2, 5)), 'addresses')
            ->has(UserPayment::factory()->count(fake()->numberBetween(2, 5)), 'payments')
            ->create();

        // create a shopping session for a user
        $session = ShoppingSession::factory()
            ->for($user, 'user')
            ->create();

        Product::factory()
            ->for(ProductCategory::factory(), 'category')
            ->for(ProductInventory::factory(), 'inventory')
            ->for(Discount::factory(), 'discount')
            // enabling order item breaks the seeding
            // ->has(
            //     OrderItem::factory(fake()->numberBetween(5, 20))
            //         ->has(OrderDetail::factory(), 'order'),
            //     'orderItems'
            // )
            ->has(
                // attach the session to the cart items
                CartItem::factory(fake()->numberBetween(5, 20))
                    ->for($session, 'shoppingSession'),
                'cartItems'
            )
            ->count(10)
            ->create();

        $this->command->info('Finished seeding product categories and products');
    }
}
