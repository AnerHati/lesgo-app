<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\StudyClassStatus;
use App\Enums\ScheduleStatus;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class StudyClass extends Model
{
    use SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'student_id',
        'tutor_id',
        'subject_id',
        'status',
        'metode_belajar',
        'paket_mengajar',
        'progress_percentage',
        'preferred_start_time',
    ];

    protected $casts = [
        'status' => StudyClassStatus::class,
    ];

    /**
     * Allowed status transitions.
     */
    protected static array $transitions = [
        StudyClassStatus::PENDING->value => [StudyClassStatus::ACTIVE->value, StudyClassStatus::CANCELLED->value],
        StudyClassStatus::ACTIVE->value => [StudyClassStatus::COMPLETED->value, StudyClassStatus::CANCELLED->value],
        StudyClassStatus::COMPLETED->value => [],
        StudyClassStatus::CANCELLED->value => [],
    ];

    /**
     * Transition to a new status if valid.
     */
    public function transitionTo(StudyClassStatus $newStatus): void
    {
        $currentStatus = $this->status->value;
        $allowed = self::$transitions[$currentStatus] ?? [];

        if (!in_array($newStatus->value, $allowed)) {
            throw new \Exception("Transisi status dari {$currentStatus} ke {$newStatus->value} tidak diizinkan.");
        }

        $this->update(['status' => $newStatus]);
    }

    /**
     * Update progress percentage based on completed schedules.
     */
    public function updateProgress(): void
    {
        $totalSchedules = $this->schedules()->count();
        if ($totalSchedules === 0) {
            $this->update(['progress_percentage' => 0]);
            return;
        }

        $completedSchedules = $this->schedules()
            ->where('status', ScheduleStatus::COMPLETED)
            ->count();

        $percentage = (int) round(($completedSchedules / $totalSchedules) * 100);
        $this->update(['progress_percentage' => $percentage]);

        // Auto-complete if 100%
        if ($percentage >= 100 && $this->status === StudyClassStatus::ACTIVE) {
            $this->transitionTo(StudyClassStatus::COMPLETED);
        }
    }

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
