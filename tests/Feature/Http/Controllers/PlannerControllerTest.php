<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Planner;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PlannerController
 */
class PlannerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $planners = Planner::factory()->count(3)->create();

        $response = $this->get(route('planner.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlannerController::class,
            'store',
            \App\Http\Requests\PlannerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $team_id = $this->faker->numberBetween(-10000, 10000);
        $quiz_id = $this->faker->numberBetween(-10000, 10000);
        $start_at = $this->faker->date();
        $end_at = $this->faker->date();

        $response = $this->post(route('planner.store'), [
            'team_id' => $team_id,
            'quiz_id' => $quiz_id,
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);

        $planners = Planner::query()
            ->where('team_id', $team_id)
            ->where('quiz_id', $quiz_id)
            ->where('start_at', $start_at)
            ->where('end_at', $end_at)
            ->get();
        $this->assertCount(1, $planners);
        $planner = $planners->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $planner = Planner::factory()->create();

        $response = $this->get(route('planner.show', $planner));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlannerController::class,
            'update',
            \App\Http\Requests\PlannerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $planner = Planner::factory()->create();
        $team_id = $this->faker->numberBetween(-10000, 10000);
        $quiz_id = $this->faker->numberBetween(-10000, 10000);
        $start_at = $this->faker->date();
        $end_at = $this->faker->date();

        $response = $this->put(route('planner.update', $planner), [
            'team_id' => $team_id,
            'quiz_id' => $quiz_id,
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);

        $planner->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($team_id, $planner->team_id);
        $this->assertEquals($quiz_id, $planner->quiz_id);
        $this->assertEquals(Carbon::parse($start_at), $planner->start_at);
        $this->assertEquals(Carbon::parse($end_at), $planner->end_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $planner = Planner::factory()->create();

        $response = $this->delete(route('planner.destroy', $planner));

        $response->assertNoContent();

        $this->assertDeleted($planner);
    }
}
