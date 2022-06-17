<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TeamController
 */
class TeamControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $teams = Team::factory()->count(3)->create();

        $response = $this->get(route('team.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeamController::class,
            'store',
            \App\Http\Requests\TeamStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $quiz_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('team.store'), [
            'name' => $name,
            'quiz_id' => $quiz_id,
        ]);

        $teams = Team::query()
            ->where('name', $name)
            ->where('quiz_id', $quiz_id)
            ->get();
        $this->assertCount(1, $teams);
        $team = $teams->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $team = Team::factory()->create();

        $response = $this->get(route('team.show', $team));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeamController::class,
            'update',
            \App\Http\Requests\TeamUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $team = Team::factory()->create();
        $name = $this->faker->name;
        $quiz_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('team.update', $team), [
            'name' => $name,
            'quiz_id' => $quiz_id,
        ]);

        $team->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $team->name);
        $this->assertEquals($quiz_id, $team->quiz_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $team = Team::factory()->create();

        $response = $this->delete(route('team.destroy', $team));

        $response->assertNoContent();

        $this->assertDeleted($team);
    }
}
