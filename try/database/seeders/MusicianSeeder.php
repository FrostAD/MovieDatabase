<?php

namespace Database\Seeders;

use App\Models\Musician;
use Illuminate\Database\Seeder;

class MusicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Musician::factory()->count(5)->create();
    }
}
