<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\UsersTeam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UsersTeamController
 */
class UsersTeamControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $usersTeams = UsersTeam::factory()->count(3)->create();

        $response = $this->get(route('users-team.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsersTeamController::class,
            'store',
            \App\Http\Requests\UsersTeamStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $team_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('users-team.store'), [
            'user_id' => $user_id,
            'team_id' => $team_id,
        ]);

        $usersTeams = UsersTeam::query()
            ->where('user_id', $user_id)
            ->where('team_id', $team_id)
            ->get();
        $this->assertCount(1, $usersTeams);
        $usersTeam = $usersTeams->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $usersTeam = UsersTeam::factory()->create();

        $response = $this->get(route('users-team.show', $usersTeam));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsersTeamController::class,
            'update',
            \App\Http\Requests\UsersTeamUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $usersTeam = UsersTeam::factory()->create();
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $team_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('users-team.update', $usersTeam), [
            'user_id' => $user_id,
            'team_id' => $team_id,
        ]);

        $usersTeam->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user_id, $usersTeam->user_id);
        $this->assertEquals($team_id, $usersTeam->team_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $usersTeam = UsersTeam::factory()->create();

        $response = $this->delete(route('users-team.destroy', $usersTeam));

        $response->assertNoContent();

        $this->assertDeleted($usersTeam);
    }
}
