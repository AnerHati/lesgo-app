<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;

class GamificationService
{
    /**
     * Tambahkan poin ke user dan cek apakah berhak mendapatkan lencana baru.
     */
    public function addPointsToUser(User $user, int $points)
    {
        return DB::transaction(function () use ($user, $points) {
            // 1. Tambah learning_points user
            $user->increment('learning_points', $points);

            // 2. Ambil semua lencana yang belum dimiliki user
            $earnedBadgeIds = $user->badges()->pluck('badge_id')->toArray();
            
            $eligibleBadges = Badge::whereNotIn('id', $earnedBadgeIds)
                ->where('required_points', '<=', $user->learning_points)
                ->get();

            // 3. Berikan lencana jika memenuhi syarat
            foreach ($eligibleBadges as $badge) {
                $user->badges()->attach($badge->id, [
                    'earned_at' => now()
                ]);
            }

            return $user->learning_points;
        });
    }
}
