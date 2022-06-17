<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionNestedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Quiz $quiz): \Illuminate\Database\Eloquent\Collection
    {
        return $quiz->quizQuestions()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, Quiz $quiz)
    {
        return $quiz->quizQuestions()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param QuizQuestion $quizQuestion
     * @return QuizQuestion
     */
    public function show(Quiz $quiz, QuizQuestion $quizQuestion): QuizQuestion
    {
        return $quizQuestion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param QuizQuestion $quizQuestion
     * @return bool
     */
    public function update(Request $request, Quiz $quiz, QuizQuestion $quizQuestion)
    {
        return $quizQuestion->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param QuizQuestion $quizQuestion
     * @return bool
     */
    public function destroy(Quiz $quiz, QuizQuestion $quizQuestion): bool
    {
        return $quizQuestion->delete();
    }
}
