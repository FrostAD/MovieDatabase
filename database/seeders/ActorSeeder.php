<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::factory()->count(5)->create();
    }
}
