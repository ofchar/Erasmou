<?php

namespace Database\Factories;

use App\Models\Landlord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'landlord_id' => Landlord::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->words($this->faker->numberBetween(1,4), true),
            'description' => $this->faker->paragraph(3),
            'foreign_url' => $this->faker->boolean(70) ? $this->faker->url() : null,
            'city_id' => function (array $attributes) {
                return Landlord::find($attributes['landlord_id'])->city_id;
            },
            'road' => $this->faker->streetName(),
            'building_number' => $this->faker->buildingNumber(),
            'apartment_number' => $this->faker->boolean(40) ? $this->faker->secondaryAddress() : null,
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
