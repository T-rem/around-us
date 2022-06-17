<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Result;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ResultController
 */
class ResultControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $results = Result::factory()->count(3)->create();

        $response = $this->get(route('result.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ResultController::class,
            'store',
            \App\Http\Requests\ResultStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $answer_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('result.store'), [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
        ]);

        $results = Result::query()
            ->where('user_id', $user_id)
            ->where('answer_id', $answer_id)
            ->get();
        $this->assertCount(1, $results);
        $result = $results->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $result = Result::factory()->create();

        $response = $this->get(route('result.show', $result));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ResultController::class,
            'update',
            \App\Http\Requests\ResultUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $result = Result::factory()->create();
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $answer_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('result.update', $result), [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
        ]);

        $result->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user_id, $result->user_id);
        $this->assertEquals($answer_id, $result->answer_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $result = Result::factory()->create();

        $response = $this->delete(route('result.destroy', $result));

        $response->assertNoContent();

        $this->assertDeleted($result);
    }
}
