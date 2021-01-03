<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Movie;
use App\Models\User;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(4),
            'rating' => $this->faker->randomFloat(0, 0, 9999999999.),
            'rating_imbd' => $this->faker->randomFloat(0, 0, 9999999999.),
            'archived' => $this->faker->boolean,
            'timespan' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text,
            'poster' => $this->faker->word,
            'country_produced' => $this->faker->word,
            'trailer' => $this->faker->word,
        ];
    }
}
