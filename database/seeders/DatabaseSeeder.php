<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $brands = [
            'Lenova', 'Adidas', 'Nike', 'Puma', 'Acer', 'Apple', 'Samsung', 
            'Crocs', 'Zumiez', 'Charlotte',
            'FLO', 'Express', 'Guess', 'Microsoft', 'Adobe'
        ];

        foreach($brands as $b){
            \App\Models\Supplier::factory()->create([
                'name' => $b
            ]);            
        }

        \App\Models\Vendor::factory(100)->create();
        \App\Models\Supplier::factory(15)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(1000)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
