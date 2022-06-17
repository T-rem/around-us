<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\QuizAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\QuizAnswerController
 */
class QuizAnswerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $quizAnswers = QuizAnswer::factory()->count(3)->create();

        $response = $this->get(route('quiz-answer.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizAnswerController::class,
            'store',
            \App\Http\Requests\QuizAnswerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $question_id = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);
        $text = $this->faker->word;

        $response = $this->post(route('quiz-answer.store'), [
            'question_id' => $question_id,
            'position' => $position,
            'text' => $text,
        ]);

        $quizAnswers = QuizAnswer::query()
            ->where('question_id', $question_id)
            ->where('position', $position)
            ->where('text', $text)
            ->get();
        $this->assertCount(1, $quizAnswers);
        $quizAnswer = $quizAnswers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $quizAnswer = QuizAnswer::factory()->create();

        $response = $this->get(route('quiz-answer.show', $quizAnswer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizAnswerController::class,
            'update',
            \App\Http\Requests\QuizAnswerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $quizAnswer = QuizAnswer::factory()->create();
        $question_id = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);
        $text = $this->faker->word;

        $response = $this->put(route('quiz-answer.update', $quizAnswer), [
            'question_id' => $question_id,
            'position' => $position,
            'text' => $text,
        ]);

        $quizAnswer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($question_id, $quizAnswer->question_id);
        $this->assertEquals($position, $quizAnswer->position);
        $this->assertEquals($text, $quizAnswer->text);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $quizAnswer = QuizAnswer::factory()->create();

        $response = $this->delete(route('quiz-answer.destroy', $quizAnswer));

        $response->assertNoContent();

        $this->assertDeleted($quizAnswer);
    }
}
