<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandlordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'city_id' => City::factory(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->boolean(40) ? $this->faker->url() : null,
        ];
    }
}
