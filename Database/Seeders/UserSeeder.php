<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Database\factories\UserFactory;
use Modules\User\Models\CartItem;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new UserFactory())->count(100)->create();
    }
}
