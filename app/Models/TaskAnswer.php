<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['task_submission_id', 'task_question_id', 'task_option_id', 'essay_answer'];

    public function submission()
    {
        return $this->belongsTo(TaskSubmission::class, 'task_submission_id');
    }

    public function question()
    {
        return $this->belongsTo(TaskQuestion::class, 'task_question_id');
    }

    public function option()
    {
        return $this->belongsTo(TaskOption::class, 'task_option_id');
    }
}
