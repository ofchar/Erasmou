<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Landlord;
use App\Models\User;
use Illuminate\Database\Seeder;

class LandlordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Landlord::factory(20)
            ->recycle(User::all())
            ->recycle(City::all())
            ->hasApartments(rand(0, 5))
            ->create();
    }
}
