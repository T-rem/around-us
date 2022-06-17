<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizQuestionStoreRequest;
use App\Http\Requests\QuizQuestionUpdateRequest;
use App\Http\Resources\QuizQuestionCollection;
use App\Http\Resources\QuizQuestionResource;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\QuizQuestionCollection
     */
    public function index(Request $request)
    {
        $quizQuestions = QuizQuestion::all();

        return new QuizQuestionCollection($quizQuestions);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuizQuestion $quizQuestion
     * @return \App\Http\Resources\QuizQuestionResource
     */
    public function show(Request $request, QuizQuestion $quizQuestion)
    {
        return new QuizQuestionResource($quizQuestion);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuizQuestion $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, QuizQuestion $quizQuestion)
    {
        $quizQuestion->delete();

        return response()->noContent();
    }
}
