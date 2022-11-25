<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forum;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Forum::factory(1000)
            ->recycle(City::all())
            ->hasPosts(rand(0, 15))
            ->create();
    }
}
