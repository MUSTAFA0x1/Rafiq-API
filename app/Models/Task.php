<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    protected $primaryKey = 'task_id';
    protected $table = 'task_management.tasks';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'title', 'description', 'priority', 'status', 'deadline',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
