<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id' => Country::factory(),
            'province_id' => function (array $attributes) {
                $province = Country::find($attributes['country_id'])->provinces()->inRandomOrder()->first();

                return $province ? $province->id : null;
            },
            'name' => $this->faker->city(),
            'description' => $this->faker->paragraph(),
            'population' => random_int(75000, 7500000),
        ];
    }
}
