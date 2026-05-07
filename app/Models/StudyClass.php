<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyClass extends Model
{
    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
