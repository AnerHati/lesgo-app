<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'display_name',
    ];

    /**
     * Users yang memiliki role ini.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user')
                    ->withPivot(['registration_step', 'is_verified', 'ktp_path', 'ijazah_path', 'verified_at'])
                    ->withTimestamps();
    }
}
