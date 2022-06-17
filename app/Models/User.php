<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'chat_id',
        'number',
    ];

    public function results(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function teams(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Team::class,UsersTeam::class);
    }

    public function authored_teams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function planners(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Planner::class, Status::class);
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Status::class);
    }

}
