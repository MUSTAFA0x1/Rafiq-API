<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Steps extends Model
{
    protected $primaryKey = 'step_log_id';
    protected $table = 'fitness_management.step_tracking';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'step_target','step_count'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

//    public function stepLogs() {
//        return $this->hasMany(StepsLog::class, 'step_log_id', 'step_log_id');
//    }
}
