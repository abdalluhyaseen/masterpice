<?php

namespace Database\Seeders;

use App\Models\field_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class field_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        field_type::factory()->count(2)->create();
    }
}
