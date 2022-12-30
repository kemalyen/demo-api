<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Product '. fake()->colorName() .' - '. fake()->numberBetween(1, 100),
            'sku' => fake()->ean8(),
            'price' => fake()->numberBetween(1, 20),
            'category_id' => Category::inRandomOrder()->first()->id,
            'supplier_id' => Supplier::inRandomOrder()->first()->id
        ];
    }
}
