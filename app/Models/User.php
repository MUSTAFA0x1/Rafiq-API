<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $table = 'user_management.users';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'magic_points',
    ];

    protected $hidden = [
        'password',
    ];

    public function tasks() {
        return $this->hasMany(Task::class, 'user_id', 'user_id');
    }

    public function stepPlans() {
        return $this->hasMany(Steps::class, 'user_id', 'user_id');
    }

    public function waterTracking() {
        return $this->hasMany(Water::class, 'user_id', 'user_id');
    }

    public function prayers() {
        return $this->hasMany(Prayers::class, 'user_id', 'user_id');
    }

    // JWT Implementation
    public function getJWTIdentifier() {
        return (string) $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
