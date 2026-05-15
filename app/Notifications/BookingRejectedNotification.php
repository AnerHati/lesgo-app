<?php

namespace App\Notifications;

use App\Models\StudyClass;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingRejectedNotification extends Notification implements ShouldQueue
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
            ->subject('Pesanan Kelas Ditolak - LesGo')
            ->greeting('Halo ' . $this->studyClass->student->name . '!')
            ->line('Mohon maaf, tutor belum dapat menerima pesanan kelas Anda untuk mata pelajaran ' . ($this->studyClass->subject->name ?? '') . ' saat ini.')
            ->line('Jangan khawatir, Anda dapat mencoba mencari tutor lain yang sesuai dengan jadwal Anda di dashboard.')
            ->action('Cari Tutor Lain', url('/dashboard-siswa'))
            ->line('Terima kasih telah menggunakan LesGo.');
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'booking_rejected',
            'message' => 'Mohon maaf, pesanan kelas ' . ($this->studyClass->subject->name ?? '') . ' belum dapat diterima oleh tutor.',
            'study_class_id' => $this->studyClass->id,
        ];
    }
}
