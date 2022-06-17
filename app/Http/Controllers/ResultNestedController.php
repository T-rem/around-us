<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\Result;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class ResultNestedController extends Controller
{

    public function getStatus(Request $request, User $manager)
    {
        $employee = Team::query()
            ->where('author', $manager->id)
            ->with(['employees' => fn(BelongsToMany $b) => $b
                ->with('status.planner.quiz')])
            ->get();

        return $employee->toArray();
    }

    public function getAnswers(Request $request, Quiz $quiz, User $user)
    {
        $result = Quiz::with([
            'quizQuestions.quizAnswers.results' => fn($x) => $x
                ->where('user_id', $user->id)
        ])->where('id', $quiz->id)->get();

        return $result->toArray();
    }

    /**
     * Display a listing of the resource.p
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function index(Request $request, QuizAnswer $quizAnswer)
    {
        return $quizAnswer->questions()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, QuizAnswer $quizAnswer)
    {
        return $quizAnswer->results()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Result $result
     * @return Result
     */
    public function show(Result $result)
    {
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Result $result
     * @return bool
     */
    public function update(Request $request, Result $result)
    {
        return $result->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Result $result
     * @return bool
     */
    public function destroy(Result $result)
    {
        return $result->delete();
    }
}
