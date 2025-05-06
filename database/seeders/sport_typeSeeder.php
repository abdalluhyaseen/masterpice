<?php

namespace Database\Seeders;

use App\Models\sport_type;
use Database\Factories\sport_typeFactory;
use Illuminate\Database\Seeder;

class sport_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        sport_type::factory()->count(5)->create();
    }
}
