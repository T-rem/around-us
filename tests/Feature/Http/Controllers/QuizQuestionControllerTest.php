<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\QuizQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\QuizQuestionController
 */
class QuizQuestionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $quizQuestions = QuizQuestion::factory()->count(3)->create();

        $response = $this->get(route('quiz-question.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizQuestionController::class,
            'store',
            \App\Http\Requests\QuizQuestionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $quiz_id = $this->faker->numberBetween(-10000, 10000);
        $text = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('quiz-question.store'), [
            'quiz_id' => $quiz_id,
            'text' => $text,
            'type' => $type,
        ]);

        $quizQuestions = QuizQuestion::query()
            ->where('quiz_id', $quiz_id)
            ->where('text', $text)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $quizQuestions);
        $quizQuestion = $quizQuestions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $quizQuestion = QuizQuestion::factory()->create();

        $response = $this->get(route('quiz-question.show', $quizQuestion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizQuestionController::class,
            'update',
            \App\Http\Requests\QuizQuestionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $quizQuestion = QuizQuestion::factory()->create();
        $quiz_id = $this->faker->numberBetween(-10000, 10000);
        $text = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('quiz-question.update', $quizQuestion), [
            'quiz_id' => $quiz_id,
            'text' => $text,
            'type' => $type,
        ]);

        $quizQuestion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($quiz_id, $quizQuestion->quiz_id);
        $this->assertEquals($text, $quizQuestion->text);
        $this->assertEquals($type, $quizQuestion->type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $quizQuestion = QuizQuestion::factory()->create();

        $response = $this->delete(route('quiz-question.destroy', $quizQuestion));

        $response->assertNoContent();

        $this->assertDeleted($quizQuestion);
    }
}
