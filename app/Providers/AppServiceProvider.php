<?php

namespace App\Providers;

use App\Http\Resources\PlannerCollection;
use App\Http\Resources\PlannerResource;
use App\Http\Resources\QuizAnswerCollection;
use App\Http\Resources\QuizAnswerResource;
use App\Http\Resources\QuizCollection;
use App\Http\Resources\QuizQuestionCollection;
use App\Http\Resources\QuizQuestionResource;
use App\Http\Resources\QuizResource;
use App\Http\Resources\ResultCollection;
use App\Http\Resources\ResultResource;
use App\Http\Resources\StatusCollection;
use App\Http\Resources\StatusResource;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersTeamCollection;
use App\Http\Resources\UsersTeamResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PlannerCollection::withoutWrapping();
        PlannerResource::withoutWrapping();
        QuizAnswerCollection::withoutWrapping();
        QuizAnswerResource::withoutWrapping();
        QuizCollection::withoutWrapping();
        QuizQuestionCollection::withoutWrapping();
        QuizQuestionResource::withoutWrapping();
        QuizResource::withoutWrapping();
        ResultCollection::withoutWrapping();
        ResultResource::withoutWrapping();
        StatusCollection::withoutWrapping();
        StatusResource::withoutWrapping();
        TeamCollection::withoutWrapping();
        TeamResource::withoutWrapping();
        UserCollection::withoutWrapping();
        UserResource::withoutWrapping();
        UsersTeamCollection::withoutWrapping();
        UsersTeamResource::withoutWrapping();
    }
}
