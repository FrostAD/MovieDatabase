<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Producer;

class ProducerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producer::class;

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
