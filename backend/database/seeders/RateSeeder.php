<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rate::factory(2000)
            ->recycle(User::all())
            ->create();
    }
}
