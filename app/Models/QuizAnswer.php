<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAnswer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'position',
        'text',
        'score',
    ];

    public function results(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function quizQuestion(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class);
    }

}
