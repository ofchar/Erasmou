<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\EsnSection;
use App\Models\Forum;
use App\Models\Landlord;
use App\Models\University;
use App\Models\User;
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
    Log::info('Seeding database');

        Country::factory(5)
            ->hasProvinces(rand(0, 10))
            ->create();
    Log::info('10%');

        City::factory(20)
            ->recycle(Country::all())
            ->create();
    Log::info('20%');

        University::factory(40)
            ->recycle(City::all())
            ->hasFaculties(rand(0, 5))
            ->create();
    Log::info('30%');

        User::factory(20)
            ->recycle(City::all())
            ->create();
    Log::info('40%');

        Landlord::factory(20)
            ->recycle(User::all())
            ->recycle(City::all())
            ->hasApartments(rand(0, 5))
            ->create();
    Log::info('60%');

        EsnSection::factory(30)
            ->recycle(University::all())
            ->recycle(City::all())
            ->create();
    Log::info('80%');

        Forum::factory(10)
            ->recycle(City::all())
            ->hasPosts(rand(0, 10))
            ->create();

    Log::info('100%');
    }
}
