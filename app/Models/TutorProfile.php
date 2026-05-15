<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TutorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'hourly_rate',
        'experience_years',
        'education',
        'teaching_method',
        'subjects_taught',
        'availability',
        'rating',
        'total_reviews',
    ];

    protected function casts(): array
    {
        return [
            'subjects_taught' => 'array',
            'availability' => 'array',
            'hourly_rate' => 'decimal:2',
            'rating' => 'decimal:2',
            'education' => 'encrypted',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
