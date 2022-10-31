<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id' => City::factory(),
            'country_id' => function (array $attributes) {
                return City::find($attributes['city_id'])->country_id;
            },
            'name' => ( $this->faker->boolean() ? 'Technical University of ' : 'University of ' ) . $this->faker->company(),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
