<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Http\Resources\QuizCollection;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\QuizCollection
     */
    public function index(Request $request)
    {
        $quizzes = Quiz::all();

        return new QuizCollection($quizzes);
    }

    /**
     * @param \App\Http\Requests\QuizStoreRequest $request
     * @return \App\Http\Resources\QuizResource
     */
    public function store(QuizStoreRequest $request)
    {
        $quiz = Quiz::create($request->validated());

        return new QuizResource($quiz);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Quiz $quiz
     * @return \App\Http\Resources\QuizResource
     */
    public function show(Request $request, Quiz $quiz)
    {
        return new QuizResource($quiz);
    }

    /**
     * @param \App\Http\Requests\QuizUpdateRequest $request
     * @param \App\Models\Quiz $quiz
     * @return \App\Http\Resources\QuizResource
     */
    public function update(QuizUpdateRequest $request, Quiz $quiz)
    {
        $quiz->update($request->validated());

        return new QuizResource($quiz);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Quiz $quiz)
    {
        $quiz->delete();

        return response()->noContent();
    }
}
