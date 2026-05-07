<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = ['id'];

    public function tutors()
    {
        return $this->belongsToMany(User::class, 'tutor_subjects')
                    ->withPivot('price_per_hour')
                    ->withTimestamps();
    }
}
