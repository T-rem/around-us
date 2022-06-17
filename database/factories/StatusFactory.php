<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Status;

class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'planner_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 20),
            'status' => $this->faker->randomElement(['started','finished', 'waiting']),
        ];
    }
}
