<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Ambil semua notifikasi user yang login
    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->take(20)->get();

        return response()->json($notifications);
    }

    // Hitung notifikasi yang belum dibaca
    public function unreadCount()
    {
        $count = Auth::user()->unreadNotifications()->count();

        return response()->json(['count' => $count]);
    }

    // Tandai satu notifikasi sebagai sudah dibaca
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['message' => 'Notifikasi sudah dibaca.']);
    }

    // Tandai semua notifikasi sebagai sudah dibaca
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return response()->json(['message' => 'Semua notifikasi sudah dibaca.']);
    }
}
