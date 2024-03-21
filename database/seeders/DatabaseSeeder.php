<?php

namespace Database\Seeders;

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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Starting seeding product categories and products...');
        // Seed Product Categories and Products
        ProductCategory::factory(5)->create()->each(function ($category) {
            Product::factory(10)->create(['category_id' => $category->id])->each(function ($product) {
                $productInventory = ProductInventory::factory()->create();
                $product->inventory_id = $productInventory->id;
                $product->save();
    
                if (rand(0, 1)) {
                    $discount = Discount::factory()->create();
                    $product->discount_id = $discount->id;
                    $product->save();
                }
            });
        });
        $this->command->info('Finished seeding product categories and products');
    
        // Seed Users with their related data
        User::factory(1)->create()->each(function ($user) {
            $this->command->info('Starting seeding user...');
            UserAddress::factory(2)->create(['user_id' => $user->id]);
            UserPayment::factory(2)->create(['user_id' => $user->id]);
            
            // Create a Shopping Session with Cart Items for each User
            $shoppingSession = ShoppingSession::factory()->create(['user_id' => $user->id]);
            CartItem::factory(3)->create([
                'session_id' => $shoppingSession->id,
                'product_id' => Product::inRandomOrder()->value('id') // Assume we have products seeded
            ]);
    
            $this->command->info('Creating order detail for user ' . $user->id);
            $orderDetail = OrderDetail::factory()->create(['user_id' => $user->id]);
            $this->command->info('Finished creating order detail for user ' . $user->id);

            for ($i = 0; $i < 3; $i++) {
                $product_id = Product::inRandomOrder()->value('id');
                $this->command->info('Creating order item with product id ' . $product_id . ' for order ' . $orderDetail->id);
                OrderItem::factory()->create([
                    'order_id' => $orderDetail->id,
                    'product_id' => $product_id
                ]);
                $this->command->info('Finished creating order item with product id ' . $product_id . ' for order ' . $orderDetail->id);
            }
            $this->command->info('Finished creating order detail and order items for user ' . $user->id);

            // Create a Payment Detail for each Order Detail
            PaymentDetail::factory()->create(['order_id' => $orderDetail->id]);
        });
    
        $this->command->info('Finished seeding users and their related data');
    }
}