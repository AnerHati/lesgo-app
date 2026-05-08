<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];
    
    protected $casts = [
        'deadline' => 'datetime',
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
