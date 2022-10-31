<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class EsnSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tiedToUniversity = $this->faker->boolean(70);

        return [
            'university_id' => $tiedToUniversity ? University::factory() : null,
            'city_id' => function (array $attributes) use ($tiedToUniversity) {
                if($tiedToUniversity) {
                    return University::find($attributes['university_id'])->city_id;
                }

                return City::inRandomOrder()->first()->id;
            },
            'name' => function (array $attributes) use ($tiedToUniversity) {
                if ($tiedToUniversity) {
                    return 'ESN ' . University::find($attributes['university_id'])->name;
                }

                return 'ESN ' . City::find($attributes['city_id'])->name;
            },
            'description' => $this->faker->paragraph(3),
        ];
    }
}
