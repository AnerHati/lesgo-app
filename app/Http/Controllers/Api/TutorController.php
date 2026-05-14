<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TutorController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $lat = $user?->latitude;
        $lon = $user?->longitude;

        $query = User::whereHas('roles', fn($q) => $q->where('name', 'tutor'))
            ->with(['tutorProfile', 'taughtSubjects']);

        // Filter berdasarkan mata pelajaran (opsional)
        if ($request->filled('subject_id')) {
            $query->whereHas('taughtSubjects', fn($q) => $q->where('subjects.id', $request->subject_id));
        }

        if ($lat && $lon) {
            // Haversine via parameterized bindings — aman dari SQL injection
            $haversine = "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))";

            $query->select('users.*')
                  ->selectRaw("ROUND({$haversine}, 1) AS distance", [$lat, $lon, $lat])
                  ->orderBy('distance', 'asc');

            // Filter radius (km, opsional, default: semua)
            if ($request->filled('radius')) {
                $radius = (float) $request->radius;
                $query->havingRaw("distance <= ?", [$radius]);
            }
        } else {
            $query->select('users.*')
                  ->selectRaw("0 AS distance");
        }

        $tutors = $query->paginate(10);

        return UserResource::collection($tutors);
    }
}
