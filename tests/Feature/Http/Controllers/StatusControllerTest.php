<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StatusController
 */
class StatusControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $statuses = Status::factory()->count(3)->create();

        $response = $this->get(route('status.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StatusController::class,
            'store',
            \App\Http\Requests\StatusStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('status.store'), [
            'status' => $status,
        ]);

        $statuses = Status::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $statuses);
        $status = $statuses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $status = Status::factory()->create();

        $response = $this->get(route('status.show', $status));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StatusController::class,
            'update',
            \App\Http\Requests\StatusUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $status = Status::factory()->create();
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('status.update', $status), [
            'status' => $status,
        ]);

        $status->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $status->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $status = Status::factory()->create();

        $response = $this->delete(route('status.destroy', $status));

        $response->assertNoContent();

        $this->assertDeleted($status);
    }
}
