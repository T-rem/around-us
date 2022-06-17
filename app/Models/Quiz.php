<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function quizQuestions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function planner(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Planner::class);
    }

    public function results(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Result::class);
    }
}
