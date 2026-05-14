<?php

namespace App\Notifications;

use App\Models\StudyClass;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;

class NewBookingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public StudyClass $studyClass) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'new_booking',
            'message' => $this->studyClass->student->name . ' ingin mendaftar kelas ' . ($this->studyClass->subject->name ?? ''),
            'study_class_id' => $this->studyClass->id,
        ];
    }
}
