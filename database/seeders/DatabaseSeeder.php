<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Product::factory(12)->create();

        User::create([
            'f_name' => 'Jorem',
            'l_name' => 'Belen',
            'role_id' => 1,
            'mobile_number' => '09199406146',
            'password' =>  Hash::make('password'),
        ]);
    }
}
