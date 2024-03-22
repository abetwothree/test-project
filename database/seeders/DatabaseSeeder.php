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
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Seeding the database, One moment...');
        // Create Product Categories
        $categories = ProductCategory::factory(5)->create();

        // Create Product Inventories
        ProductInventory::factory()->create();

        // Create Discounts
        Discount::factory(5)->create();

        // Create Products
        $products = Product::factory(2)->create(['category_id' => $categories->random()->id]);

        // Create Users and related data
        $this->command->info('Creating users and its related data...');
        User::factory(20)->create()->each(function ($user) {
            // Create related addresses and payments for each user
            UserAddress::factory()->create(['user_id' => $user->id]);
            UserPayment::factory()->create(['user_id' => $user->id]);

            // Create a Shopping Session with Cart Items for each User
            $shoppingSession = ShoppingSession::factory()->create(['user_id' => $user->id]);
            CartItem::factory(3)->create([
                'session_id' => $shoppingSession->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);

            // Create PaymentDetail and OrderDetail for each User
            $paymentDetail = PaymentDetail::factory()->create();
            $orderDetail = OrderDetail::factory()->create([
                'user_id' => $user->id,
                'payment_id' => $paymentDetail->id,
            ]);

            // Create OrderItems for the OrderDetail
            OrderItem::factory(3)->create([
                'order_id' => $orderDetail->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);
        });
        $this->command->info('Database has successfully been seeded...');
    }
}
