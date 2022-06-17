<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Planner;

class PlannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Planner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_id' => $this->faker->numberBetween(1, 20),
            'quiz_id' => $this->faker->numberBetween(1, 20),
            'start_at' => $this->faker->date(),
            'end_at' => $this->faker->date(),
        ];
    }
}
