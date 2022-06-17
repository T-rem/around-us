<?php

namespace App\Http\Controllers;

use App\Models\Planner;
use App\Models\Quiz;
use App\Models\Team;
use Illuminate\Http\Request;

class QuizPlannerNestedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Quiz $quiz)
    {
        return $quiz->planner()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, Quiz $quiz)
    {
        return $quiz->planner()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planner  $planner
     * @return Planner
     */
    public function show(Planner $planner)
    {
        return $planner;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planner  $planner
     * @return bool
     */
    public function update(Request $request, Planner $planner)
    {
        return $planner->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planner  $planner
     * @return bool
     */
    public function destroy(Planner $planner)
    {
        return $planner->delete();
    }
}
