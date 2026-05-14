<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ScheduleStatus;

class Schedule extends Model
{
    protected $fillable = [
        'study_class_id',
        'start_time',
        'end_time',
        'status',
        'meeting_link',
    ];
    
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => ScheduleStatus::class,
    ];

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class);
    }
}
