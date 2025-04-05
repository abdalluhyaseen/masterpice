<?php
namespace Database\Factories;

use App\Models\Field;
use App\Models\Sport_Type;
use App\Models\Field_Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Field::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'field_name' => $this->faker->word . ' Field',
            'field_description' => $this->faker->sentence,
            'field_location' => $this->faker->address,
            'field_avilable' => $this->faker->boolean,
            'field_price' => $this->faker->randomFloat(2, 15, 50),
            'sport_type_id' => fake()->numberBetween($min = 1, $max = 14),
            'field_type_id' =>  fake()->numberBetween($min = 1, $max = 2),
        ];
    }
}
