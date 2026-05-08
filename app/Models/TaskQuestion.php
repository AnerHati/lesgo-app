<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'question', 'type'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function options()
    {
        return $this->hasMany(TaskOption::class);
    }
}
