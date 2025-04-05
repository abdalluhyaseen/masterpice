<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\field_type>
 */
class field_typeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array of actual sports names
        $field_type = [
            'indoor',
            'outdoor'
        ];

        return [
            'field_type' => $this->faker->unique()->randomElement($field_type)
        ];
    }
}
