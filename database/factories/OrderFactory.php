<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'diet_id' => $this->faker->randomNumber(),
            'delivery_start' => $this->faker->date(),
            'delivery_end' => $this->faker->date(),
            'delivery_variation_id' => $this->faker->randomNumber(),
            'comment' => $this->faker->sentence(5),
        ];
    }
}
