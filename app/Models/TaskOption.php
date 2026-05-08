<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskOption extends Model
{
    use HasFactory;

    protected $fillable = ['task_question_id', 'label', 'value', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(TaskQuestion::class, 'task_question_id');
    }
}
