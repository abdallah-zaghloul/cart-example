<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Database\factories\UserFactory;
use Modules\User\Models\CartItem;
use Modules\User\Models\Product;
use Modules\User\Models\User;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        [$products, $user_ids] = [Product::pluck('price','id'), User::pluck('id')];
        $user_ids->each(fn($user_id) => CartItem::create([
            'product_id'=> fake()->randomElement($products->flip()->all()),
            'user_id'=> $user_id,
            'count'=> rand(1, 10),
        ]));
    }
}
