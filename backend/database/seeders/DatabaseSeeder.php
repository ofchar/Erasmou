<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);

        $this->call(CitySeeder::class);

        $this->call(UniversitySeeder::class);

        $this->call(UserSeeder::class);

        $this->call(LandlordSeeder::class);

        $this->call(EsnSectionSeeder::class);

        $this->call(ForumSeeder::class);
    }
}
