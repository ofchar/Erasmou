<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faculties = [
            'Engineering',
            'Chemistry',
            'Computer Science',
            'Mathss',
            'Physics',
            'Biology',
            'Architecture',
        ];

        return [
            'university_id' => University::factory(),
            'name' => 'Faculty of ' . $this->faker->randomElement($faculties),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
