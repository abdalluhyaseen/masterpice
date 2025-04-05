<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sport_Type>
 */
class sport_typeFactory extends Factory
{
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            // Array of actual sports names
            $sports = [
                'Soccer',
                'Basketball',
                'Tennis',
                'Baseball',
                'Cricket',
                'Rugby',
                'Golf',
                'Swimming',
                'Hockey',
                'Volleyball',
                'Table Tennis',
                'Boxing',
                'MMA',
                'Athletics'
            ];
    
            return [
                'sport_type' => $this->faker->unique()->randomElement($sports)
            ];
        }
    }
    
