<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory()
            ->hasProvinces(16)
            ->create([
                'name' => 'Poland',
                'code' => 'PL',
                'flag_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/1/12/Flag_of_Poland.svg/1200px-Flag_of_Poland.svg.png',
            ]);

        Country::factory()
            ->hasProvinces(rand(0, 10))
            ->create([
                'name' => 'Italy',
                'code' => 'IT',
                'flag_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/0/03/Flag_of_Italy.svg/1920px-Flag_of_Italy.svg.png',
            ]);

        Country::factory()
            ->hasProvinces(rand(0, 10))
            ->create([
                'name' => 'Mexico',
                'code' => 'MX',
                'flag_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/2560px-Flag_of_Mexico.svg.png',
            ]);
    }
}
