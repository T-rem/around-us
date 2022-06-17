<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizAnswerNestedController extends Controller
{
    /**
     * Display a listing of the resource.
     *1
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Quiz $quiz, QuizQuestion $quizQuestion)
    {
        return $quizQuestion->quizAnswers()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, QuizQuestion $question)
    {
        return $question->quizAnswers()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return QuizAnswer
     */
    public function show(QuizQuestion $quizQuestion, QuizAnswer $quizAnswer)
    {
        return $quizAnswer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return bool|\Illuminate\Http\Response
     */
    public function update(Request $request, QuizAnswer $quizAnswer)
    {
        return $quizAnswer->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return bool
     */
    public function destroy(QuizAnswer $quizAnswer): bool
    {
        return $quizAnswer->delete();
    }
}
