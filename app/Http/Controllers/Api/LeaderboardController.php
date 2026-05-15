<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LeaderboardController extends Controller
{
    /**
     * Get the top students by learning points.
     */
    public function index()
    {
        // Cache leaderboard for 10 minutes
        $leaderboard = Cache::remember('gamification.leaderboard', 600, function () {
            return User::whereHas('roles', fn($q) => $q->where('name', 'siswa'))
                ->orderBy('learning_points', 'desc')
                ->take(10)
                ->get(['id', 'name', 'profile_photo_path', 'learning_points']);
        });

        return response()->json($leaderboard);
    }
}
