<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Rateable;
use App\Models\University;
use Illuminate\Database\Seeder;

class RateableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rateable::create([
            'name' => 'Price',
            'targetable_type' => Apartment::class,
            'data_type' => Rateable::TYPE_NUMERIC,
            'description' => 'Price for apartment per month.',
            'min_value' => 1,
            'max_value' => 10000,
        ]);
        Rateable::create([
            'name' => 'Cleanliness',
            'targetable_type' => Apartment::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How clean the apartment is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Location',
            'targetable_type' => Apartment::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How good the location is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Transport',
            'targetable_type' => Apartment::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How good the public transport in this location is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Overall',
            'targetable_type' => Apartment::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How good the apartment is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);

        Rateable::create([
            'name' => 'Friendliness',
            'targetable_type' => University::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How friendly the university is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Education',
            'targetable_type' => University::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How good the education on the university is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Overall',
            'targetable_type' => University::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How good the university is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);

        Rateable::create([
            'name' => 'Prices',
            'targetable_type' => City::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How good the prices are in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Funnes',
            'targetable_type' => City::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How fun the city is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Transport',
            'targetable_type' => City::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How well does the public transport work in the city in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Overall',
            'targetable_type' => City::class,
            'data_type' => Rateable::TYPE_OPINION,
            'description' => 'How good the city is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
    }
}
