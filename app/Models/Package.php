<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'sessions_count',
        'discount_percentage',
    ];

    protected function casts(): array
    {
        return [
            'sessions_count' => 'integer',
            'discount_percentage' => 'decimal:2',
        ];
    }
}
