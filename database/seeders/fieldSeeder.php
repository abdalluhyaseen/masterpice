<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Field_images;
use App\Models\sport_type;
use App\Models\Field_type;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    public function run()
    {
        $sportType = sport_type::create(['sport_type' => 'Football']);
        $fieldType = Field_type::create(['field_type' => 'Outdoor']);

        Field::create([
            'field_name' => 'Football Field 1',
            'field_type_id' => $fieldType->id,
            'sport_type_id' => $sportType->id,
            'description' => 'A football field.',
        ]);
    }
}

