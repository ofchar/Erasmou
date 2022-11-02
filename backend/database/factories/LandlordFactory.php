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
            'name' => $this->faker->boolean(60) ? $this->faker->name() : $this->faker->company(),
            'user_id' => User::factory(),
            'city_id' => City::factory(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->boolean(40) ? $this->faker->url() : null,
        ];
    }
}
