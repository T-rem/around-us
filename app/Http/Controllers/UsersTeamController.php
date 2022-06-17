<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\UsersTeam;
use Illuminate\Http\Request;

class UsersTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(User $user)
    {
        return $user->teams()->get();
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
        return UsersTeam::where('team_id =' .$team['id']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return bool
     */
    public function update(Request $request, UsersTeam $usersTeam)
    {
        return $usersTeam->where->update($request->validated());
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
