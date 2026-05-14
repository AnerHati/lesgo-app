<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'study_class_id',
        'content',
    ];

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class);
    }
}
