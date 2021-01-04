<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Actor;

class ActorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'born_date' => $this->faker->date(),
            'born_place' => $this->faker->word,
            'description' => $this->faker->text,
            'image' => $this->faker->word,
            'archived' => $this->faker->boolean,
        ];
    }
}
