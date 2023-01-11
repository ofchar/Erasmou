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
            'username' => 'ofchar',
            'first_name' => 'Mateusz',
            'last_name' => 'Owczarek',
            'email' => '230460@edu.p.lodz.pl',
            'phone' => '+48 720880889',
            'bio' => 'hi im the best',
            'type' => 100,
            'country_id' => 1,
            'city_id' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}
