<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\UsersTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamNestedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function index(User $user)
    {
        return $user->teams();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, User $user)
    {
        return $user->teams()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return Team
     */
    public function show(Team $team)
    {
        return $team;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return bool
     */
    public function update(Request $request, Team $team)
    {
        return $team->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return bool
     */
    public function destroy(Team $team)
    {
        return $team->delete();
    }
}
