<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $forumables = [
            City::class,
            University::class,
        ];

        $forumable = $this->faker->randomElement($forumables);

        return [
            'forumable_type' => $forumable,
            'forumable_id' => $forumable::factory(),
            'name' => function (array $attributes) use ($forumable) {
                return $this->faker->word() . ' ' . $forumable::find($attributes['forumable_id'])->name . ' Forum';
            },
            'description' => $this->faker->paragraph(),
        ];
    }
}
