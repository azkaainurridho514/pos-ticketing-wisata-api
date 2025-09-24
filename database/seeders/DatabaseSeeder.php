<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(27)->create();  
        User::factory()->create([
            'name' => 'Azka Ainurridho',
            'email' => 'azka@example.com',
            'password' => Hash::make('12345'),
            'role' => 'admin'
        ]);
        Category::factory(5)->create();
        Product::factory(100)->create();
    }
}
