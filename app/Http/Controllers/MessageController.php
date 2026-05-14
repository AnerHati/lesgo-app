<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyClass;
use App\Models\User;
use App\Models\Message;
use App\Enums\StudyClassStatus;

use App\Http\Requests\StoreMessageRequest;

class MessageController extends Controller
{
    public function getContacts()
    {
        $user = Auth::user();
        $contacts = collect([]);

        if ($user->hasRole('siswa')) {
            $tutorIds = StudyClass::where('student_id', $user->id)
                ->whereIn('status', [StudyClassStatus::ACTIVE, StudyClassStatus::COMPLETED])
                ->pluck('tutor_id')->unique();
            $contacts = User::whereIn('id', $tutorIds)->get();
        } else if ($user->hasRole('tutor')) {
            $studentIds = StudyClass::where('tutor_id', $user->id)
                ->whereIn('status', [StudyClassStatus::ACTIVE, StudyClassStatus::COMPLETED])
                ->pluck('student_id')->unique();
            $contacts = User::whereIn('id', $studentIds)->get();
        }

        // Add unread_count and latest_message to each contact
        $contacts->each(function ($contact) use ($user) {
            $contact->unread_count = Message::where('sender_id', $contact->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();
            return $contact;
        });

        return response()->json($contacts);
    }

    public function fetchMessages($contactId)
    {
        $userId = Auth::id();

        // Cek ada StudyClass yang menghubungkan kedua user
        $hasRelationship = StudyClass::whereIn('status', [StudyClassStatus::ACTIVE, StudyClassStatus::COMPLETED])
            ->where(function ($q) use ($userId, $contactId) {
                $q->where(function ($q2) use ($userId, $contactId) {
                    $q2->where('student_id', $userId)->where('tutor_id', $contactId);
                })->orWhere(function ($q2) use ($userId, $contactId) {
                    $q2->where('student_id', $contactId)->where('tutor_id', $userId);
                });
            })->exists();

        if (!$hasRelationship) {
            return response()->json(['message' => 'Anda tidak memiliki kelas aktif dengan user ini.'], 403);
        }

        $messages = Message::where(function($q) use ($userId, $contactId) {
            $q->where('sender_id', $userId)->where('receiver_id', $contactId);
        })->orWhere(function($q) use ($userId, $contactId) {
            $q->where('sender_id', $contactId)->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        // Mark as read
        Message::where('sender_id', $contactId)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

    public function sendMessage(StoreMessageRequest $request)
    {
        $userId = Auth::id();
        $receiverId = $request->receiver_id;

        // Cek ada StudyClass yang menghubungkan kedua user
        $hasRelationship = StudyClass::whereIn('status', [StudyClassStatus::ACTIVE, StudyClassStatus::COMPLETED])
            ->where(function ($q) use ($userId, $receiverId) {
                $q->where(function ($q2) use ($userId, $receiverId) {
                    $q2->where('student_id', $userId)->where('tutor_id', $receiverId);
                })->orWhere(function ($q2) use ($userId, $receiverId) {
                    $q2->where('student_id', $receiverId)->where('tutor_id', $userId);
                });
            })->exists();

        if (!$hasRelationship) {
            return response()->json(['message' => 'Anda tidak memiliki kelas aktif dengan user ini.'], 403);
        }

       $message = Message::create([
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'is_read' => false
        ]);

        broadcast(new \App\Events\MessageSent($message))->toOthers();


        return response()->json($message);
    }
}
