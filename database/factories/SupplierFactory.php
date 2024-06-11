<?php

namespace Database\Factories;

use App\Enums\SupplierType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shopname = fake()->company();
        return [
            "user_id" => 1,
            "uuid" => Str::uuid(),
            'name' => $shopname,
            'email' => fake()->unique()->safeEmail(),
        //    'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'shopname' => $shopname,
        //    'type' => fake()->randomElement(SupplierType::cases()),
        //    'account_holder' => fake()->name(),
        //    'account_number' => fake()->randomNumber(8, true),
        //    'bank_name' => fake()->randomElement(['BRI', 'BNI', 'BCA', 'BSI', 'Mandiri']),
        ];
    }
}
