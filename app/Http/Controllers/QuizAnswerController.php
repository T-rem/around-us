<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizAnswerStoreRequest;
use App\Http\Requests\QuizAnswerUpdateRequest;
use App\Http\Resources\QuizAnswerCollection;
use App\Http\Resources\QuizAnswerResource;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\QuizAnswerCollection
     */
    public function index(Request $request)
    {
        $quizAnswers = QuizAnswer::all();

        return new QuizAnswerCollection($quizAnswers);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuizAnswer $quizAnswer
     * @return \App\Http\Resources\QuizAnswerResource
     */
    public function show(Request $request, QuizAnswer $quizAnswer)
    {
        return new QuizAnswerResource($quizAnswer);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuizAnswer $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, QuizAnswer $quizAnswer)
    {
        $quizAnswer->delete();

        return response()->noContent();
    }
}
