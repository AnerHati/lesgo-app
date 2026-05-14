<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;

class Task extends Model
{
    protected $fillable = [
        'study_class_id',
        'title',
        'description',
        'deadline',
        'status',
        'score',
    ];
    
    protected $casts = [
        'deadline' => 'datetime',
        'status' => TaskStatus::class,
    ];

   // Tambahkan di dalam class Task

public function questions()
{
    return $this->hasMany(TaskQuestion::class);
}

public function submissions()
{
    return $this->hasMany(TaskSubmission::class);
}

public function comments()
{
    return $this->hasMany(TaskComment::class);
}
public function studyClass()
{
    return $this->belongsTo(StudyClass::class);
}
public function attachments()
{
    return $this->morphMany(Attachment::class, 'attachable');
}


}
