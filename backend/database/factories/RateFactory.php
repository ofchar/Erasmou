<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Rateable;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $targetables = [
            Apartment::class,
            City::class,
            University::class,
        ];

        $targetableClass = $this->faker->randomElement($targetables);
        $targetable = $targetableClass::inRandomOrder()->first();

        $rateable = Rateable::whereTargetableType($targetableClass)->inRandomOrder()->first();

        $value = 'xd';
        switch($rateable->data_type) {
            case Rateable::TYPE_NUMERIC:
            case Rateable::TYPE_OPINION:
                $value = $this->faker->numberBetween(
                    $rateable->min_value ?? 0,
                    $rateable->max_value ?? PHP_INT_MAX
                );
                break;
            case Rateable::TYPE_STRING:
                $value = $this->faker->sentence();
                break;
        }

        return [
            'targetable_type' => $targetableClass,
            'targetable_id' => $targetable->id,
            'rateable_id' => $rateable->id,
            'value' => $value,
            'comment' => $this->faker->boolean(30) ? $this->faker->paragraph() : null,
            'user_id' => User::factory(),
        ];
    }
}
