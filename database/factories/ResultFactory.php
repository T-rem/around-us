<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Result;

class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Result::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'quiz_answer_id' => $this->faker->numberBetween(1, 10),
            'text' => $this->faker->word,
            'quiz_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
