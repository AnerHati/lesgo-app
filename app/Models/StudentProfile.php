<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'grade_level',
        'school_name',
        'bio',
        'learning_goals',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
