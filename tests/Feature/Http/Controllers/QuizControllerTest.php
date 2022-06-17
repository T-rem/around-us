<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\QuizController
 */
class QuizControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $quizzes = Quiz::factory()->count(3)->create();

        $response = $this->get(route('quiz.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizController::class,
            'store',
            \App\Http\Requests\QuizStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;

        $response = $this->post(route('quiz.store'), [
            'name' => $name,
        ]);

        $quizzes = Quiz::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $quizzes);
        $quiz = $quizzes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $quiz = Quiz::factory()->create();

        $response = $this->get(route('quiz.show', $quiz));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\QuizController::class,
            'update',
            \App\Http\Requests\QuizUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $quiz = Quiz::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('quiz.update', $quiz), [
            'name' => $name,
        ]);

        $quiz->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $quiz->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $quiz = Quiz::factory()->create();

        $response = $this->delete(route('quiz.destroy', $quiz));

        $response->assertNoContent();

        $this->assertDeleted($quiz);
    }
}
