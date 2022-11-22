<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Province;
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
            ->hasCities(40)
            ->create([
                'name' => 'Poland',
                'code' => 'PL',
                'flag_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/1/12/Flag_of_Poland.svg/1200px-Flag_of_Poland.svg.png',
                'description' => 'Officially the Republic of Poland, is a country in Central Europe. It is divided into 16 administrative provinces called voivodeships, covering an area of 312,696 km2 (120,733 sq mi). Poland has a population of over 38 million and is the fifth-most populous member state of the European Union.',
            ]);

        Country::factory()
            ->hasProvinces(20)
            ->hasCities(60)
            ->create([
                'name' => 'Italy',
                'code' => 'IT',
                'flag_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/0/03/Flag_of_Italy.svg/1920px-Flag_of_Italy.svg.png',
                'description' => 'Is a country located in the middle of the Mediterranean Sea, in Southern Europe; it is also considered part of Western Europe. A unitary parliamentary republic with Rome as its capital and largest city, the country covers a total area of 301,230 km2 (116,310 sq mi) and shares land borders with France, Switzerland, Austria, Slovenia and the enclaved microstates of Vatican City and San Marino. Italy has a territorial exclave in Switzerland, Campione. With over 60 million inhabitants, Italy is the third-most populous member state of the European Union.',
            ]);

        Country::factory()
            ->hasCities(50)
            ->create([
                'name' => 'Mexico',
                'code' => 'MX',
                'flag_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/2560px-Flag_of_Mexico.svg.png',
                'description' => 'Is a country in the southern portion of North America. It is bordered to the north by the United States; to the south and west by the Pacific Ocean; to the southeast by Guatemala, Belize, and the Caribbean Sea; and to the east by the Gulf of Mexico. Mexico covers 1,972,550 square kilometers (761,610 sq mi), making it the worlds 13th-largest country by area; with approximately 126,014,024 inhabitants, it is the 10th-most-populous country and has the most Spanish-speakers.',
            ]);


        // Country::factory(3)
        //     ->hasProvinces(rand(0, 10))
        //     ->create();
    }
}
