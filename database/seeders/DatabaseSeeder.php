<?php

namespace Database\Seeders;



use App\Models\Planner;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\Result;
use App\Models\Status;
use App\Models\Team;
use App\Models\User;
use App\Models\UsersTeam;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $results = Result::factory()->count(5);

        Quiz::factory()
            ->count(10)
            ->has(
                QuizQuestion::factory()
                    ->count(10)
                    ->has(
                        QuizAnswer::factory()
                            ->count(10)->has(
                                $results
                            )
                    )
            )->has(Planner::factory()->count(1))->create();

        User::factory()->count(20)->has($results)->create();
        Team::factory()->count(100)->create();
        UsersTeam::factory()->count(100)->create();
        Status::factory()->count(10)->create();
    }
}
