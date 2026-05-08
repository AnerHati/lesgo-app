<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    // Tambahkan 'content' di sini
    protected $fillable = [
        'study_class_id', 
        'title', 
        'description', 
        'content', 
        'order_index', 
        'status'
    ];

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class);
    }

    // Tambahkan relasi ke tugas (1 materi bisa memiliki banyak tugas)
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function attachments()
{
    return $this->morphMany(Attachment::class, 'attachable');
}

}
