<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'topic',
        'tutor_name',
    ];

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}
