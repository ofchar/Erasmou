<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\University;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        University::factory(350)
            ->recycle(City::all())
            ->hasFaculties(rand(0, 5))
            ->create();
    }
}
