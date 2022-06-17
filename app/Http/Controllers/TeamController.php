<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\TeamCollection
     */
    public function index(Request $request)
    {
        $teams = Team::all();

        return new TeamCollection($teams);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team $team
     * @return \App\Http\Resources\TeamResource
     */
    public function show(Request $request, Team $team)
    {
        return new TeamResource($team);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Team $team)
    {
        $team->delete();

        return response()->noContent();
    }
}
