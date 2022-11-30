<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forum;
use App\Models\User;
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
        Forum::factory(300)
            ->recycle(City::all())
            ->recycle(User::all())
            ->hasPosts(rand(0, 15))
            ->create();
    }
}
