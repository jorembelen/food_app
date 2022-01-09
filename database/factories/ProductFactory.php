<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            $product_name = $this->faker->unique()->words($nb=2,$asText=true);

            return [
                'name' => $product_name,
                'is_featured' => $this->faker->numberBetween(0,1),
                'description' => $this->faker->text(200),
                'regular_price' => $this->faker->numberBetween(50, 250),
                'quantity' => $this->faker->numberBetween(10, 20),
                'image' => 'product-' .$this->faker->numberBetween(1, 12). '.jpg',

            ];
    }
}
