<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\QuizQuestion;

class QuizQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuizQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quiz_id' => $this->faker->numberBetween(1, 100),
            'text' => $this->faker->text(),
            'type' => $this->faker->randomElement(['open','closed']),
            'position' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->text,
        ];
    }
}
