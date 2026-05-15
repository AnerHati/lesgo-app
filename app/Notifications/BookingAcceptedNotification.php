<?php

namespace App\Notifications;

use App\Models\StudyClass;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingAcceptedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public StudyClass $studyClass) {}

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pesanan Kelas Diterima - LesGo')
            ->greeting('Halo ' . $this->studyClass->student->name . '!')
            ->line('Kabar gembira! Pesanan kelas Anda untuk mata pelajaran ' . ($this->studyClass->subject->name ?? '') . ' telah diterima oleh tutor.')
            ->line('Jadwal belajar Anda telah dibuat secara otomatis. Silakan cek dashboard Anda untuk melihat rincian jadwal.')
            ->action('Lihat Dashboard', url('/dashboard-siswa'))
            ->line('Selamat belajar!');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'booking_accepted',
            'message' => 'Pesanan kelas ' . ($this->studyClass->subject->name ?? '') . ' telah diterima oleh tutor.',
            'study_class_id' => $this->studyClass->id,
        ];
    }
}
