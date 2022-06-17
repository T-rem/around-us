<?php

use App\Http\Controllers\PlannerController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\QuizAnswerNestedController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizPlannerNestedController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\QuizQuestionNestedController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamNestedController;
use App\Http\Controllers\TeamPlannerNestedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersTeamController;
use App\Http\Controllers\ResultNestedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('team', TeamController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('quiz-question', QuizQuestionController::class);
Route::apiResource('quiz', QuizController::class);
Route::apiResource('planner', PlannerController::class);
Route::apiResource('quiz-answer', QuizAnswerController::class);
Route::apiResource('users-team', UsersTeamController::class);
Route::apiResource('result', ResultController::class);

Route::apiResource('quiz.quiz-question', QuizQuestionNestedController::class);
Route::apiResource('quiz.quiz-question.quiz-answer', QuizAnswerNestedController::class);
Route::apiResource('quiz.quiz-question.quiz-answer.results', ResultNestedController::class);

Route::get('get_answers/{quiz}/{user}', [ResultNestedController::class, 'getAnswers']);

Route::get('get_results/{manager}', [ResultNestedController::class, 'getStatus']);

Route::apiResource('team.planner', TeamPlannerNestedController::class);
Route::apiResource('quiz.planner', QuizPlannerNestedController::class);

Route::apiResource('user.team', TeamNestedController::class);


Route::apiResource('status', App\Http\Controllers\StatusController::class);
