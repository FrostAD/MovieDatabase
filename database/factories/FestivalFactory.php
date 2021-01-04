<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Festival;
use App\Models\User;

class FestivalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Festival::class;

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
            'location' => $this->faker->word,
            'description' => $this->faker->text,
            'image' => $this->faker->word,
        ];
    }
}
