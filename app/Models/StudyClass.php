<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StudyClass extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
 
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function review()
{
    return $this->hasOne(Review::class);
}

}
