<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\QuizAnswer;

class QuizAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuizAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quiz_question_id' => $this->faker->numberBetween(1, 10),
            'position' => $this->faker->numberBetween(1, 10),
            'text' => $this->faker->word,
            'score' => $this->faker->numberBetween(1, 10),
        ];
    }
}
