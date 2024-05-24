<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $inv_counter = 1;
        $orderStatuses = [1, 0];
        $products = Product::all(); // Assuming you have a products table with some products

        for ($day = 0; $day < 365; $day++) {
            $date = Carbon::now()->subDays(365 - $day);
            for ($orderCount = 0; $orderCount < 75; $orderCount++) {
                $orderDate = $date->timestamp;
                $orderStatus = fake()->randomElement($orderStatuses);

                $userId = User::inRandomOrder()->first()->id;

                $order = Order::create([
                    'uuid' => fake()->uuid(),
                    'user_id' => $userId,
                    'order_date' => $orderDate,
                    'order_status' => 1,
                    'total_products' => 0, // Will be updated later
                    'total' => 0, // Will be updated later
                    'invoice_no' => 'INV-'. $inv_counter++,
                    'payment_type' => 'cash',
                    'pay' => 0,
                    'due' => 0,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate
                ]);

                $totalAmount = 0;
                $totalQuantity = 0;
                $numOfDetails = rand(1, 5); // Each order has between 1 to 5 products

                for ($i = 0; $i < $numOfDetails; $i++) {
                    $product = $products->random();
                    $quantity = rand(1, 10);
                    $unitCost = $product->selling_price; // Assuming you have a price field in products table
                    $total = $quantity * $unitCost;

                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unitcost' => $unitCost,
                        'total' => $total,
                        'created_at' => $orderDate,
                        'updated_at' => $orderDate
                    ]);

                    $totalAmount += $total;
                    $totalQuantity += $quantity;
                }

                // Update order with the total amount and quantity
                $order->update([
                    'total_products' => $totalAmount,
                    'total' => $totalQuantity,
                    'pay' => $totalAmount
                ]);
            }
        }

    }
}
