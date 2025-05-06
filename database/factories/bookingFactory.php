<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\booking>
 */
class bookingFactory extends Factory
{
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'total_price' => fake()->numberBetween($min = 10, $max = 90),
                'status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled']),
                'user_id' => fake()->numberBetween($min = 1, $max = 10),
                'field_id' => fake()->numberBetween($min = 1, $max = 22),
            ];
        }
    }

