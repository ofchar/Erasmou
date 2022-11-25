<?php

namespace Database\Seeders;

use App\Models\Rateable;
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
            'targetable_type' => 'App\\Models\\Apartment',
            'data_type' => Rateable::TYPE_FLOAT,
            'description' => 'Price for apartment per month.',
            'min_value',
            'max_value',
        ]);
        Rateable::create([
            'name' => 'Cleanliness',
            'targetable_type' => 'App\\Models\\Apartment',
            'data_type' => Rateable::TYPE_INT,
            'description' => 'How clean the apartment is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
        Rateable::create([
            'name' => 'Location',
            'targetable_type' => 'App\\Models\\Apartment',
            'data_type' => Rateable::TYPE_INT,
            'description' => 'How good the location is in 1-10 scale.',
            'min_value' => 1,
            'max_value' => 10,
        ]);
    }
}
