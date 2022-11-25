<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\EsnSection;
use App\Models\University;
use Illuminate\Database\Seeder;

class EsnSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EsnSection::factory(100)
            ->recycle(University::all())
            ->recycle(City::all())
            ->create();
    }
}
