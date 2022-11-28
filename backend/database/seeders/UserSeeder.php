<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)
            ->recycle(City::all())
            ->create();

        User::create([
            'username' => 'theDestroyer',
            'first_name' => 'the',
            'last_name' => 'destroyer',
            'email' => 'thedestroyer@69420.2137',
            'phone' => '69696969',
            'bio' => 'elko',
            'type' => 100,
            'country_id' => 1,
            'city_id' => 1,
            'password' => Hash::make('password'),
        ])
    }
}
