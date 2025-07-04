<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    protected $table = 'fitness_management.water_tracking';
    protected $primaryKey = 'water_log_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'cup_size', 'wake_up_time', 'sleep_time', 'water_target', 'total_amount',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

//    public function logs() {
//        return $this->hasMany(WaterLog::class, 'water_log_id');
//    }
}
