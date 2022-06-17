<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'quiz_id',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function team(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UsersTeam::class);
    }

    public function statuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Status::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(User::class, Status::class);
    }
}
