<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\Movie;
use App\Models\User;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'date' => $this->faker->date(),
            'capacity' => $this->faker->numberBetween(-10000, 10000),
            'current_cappacity' => $this->faker->numberBetween(-10000, 10000),
            'location' => $this->faker->word,
            'description' => $this->faker->text,
            'movie_id' => Movie::factory(),
        ];
    }
}
