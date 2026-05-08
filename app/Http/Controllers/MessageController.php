<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getContacts()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $contacts = collect([]);

        if ($user->hasRole('siswa')) {
            $tutorIds = \App\Models\StudyClass::where('student_id', $user->id)
                ->whereIn('status', ['active', 'completed'])
                ->pluck('tutor_id')->unique();
            $contacts = \App\Models\User::whereIn('id', $tutorIds)->get();
        } else if ($user->hasRole('tutor')) {
            $studentIds = \App\Models\StudyClass::where('tutor_id', $user->id)
                ->whereIn('status', ['active', 'completed'])
                ->pluck('student_id')->unique();
            $contacts = \App\Models\User::whereIn('id', $studentIds)->get();
        }

        // Add unread_count and latest_message to each contact
        $contacts->each(function ($contact) use ($user) {
            $contact->unread_count = \App\Models\Message::where('sender_id', $contact->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
            return $contact;
        });

        return response()->json($contacts);
    }

    public function fetchMessages($contactId)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        $messages = \App\Models\Message::where(function($q) use ($userId, $contactId) {
            $q->where('sender_id', $userId)->where('receiver_id', $contactId);
        })->orWhere(function($q) use ($userId, $contactId) {
            $q->where('sender_id', $contactId)->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        // Mark as read
        \App\Models\Message::where('sender_id', $contactId)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = \App\Models\Message::create([
            'sender_id' => \Illuminate\Support\Facades\Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false
        ]);

        return response()->json($message);
    }
}
