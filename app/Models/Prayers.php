<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prayers extends Model
{
    protected $primaryKey = 'prayer_log_id';
    protected $table = 'religious_management.prayer_tracking';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'prayer_name', 'in_mosque', 'with_nawafil','is_prayer_done'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
