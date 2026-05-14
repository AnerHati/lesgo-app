<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\TutorProfile;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        $this->updateTutorRating($review->tutor_id);
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        if ($review->wasChanged('rating')) {
            $this->updateTutorRating($review->tutor_id);
        }
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        $this->updateTutorRating($review->tutor_id);
    }

    /**
     * Recalculate and update tutor rating and review count.
     */
    protected function updateTutorRating(int $tutorId): void
    {
        $stats = Review::where('tutor_id', $tutorId)
            ->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_reviews')
            ->first();

        TutorProfile::where('user_id', $tutorId)->update([
            'rating' => $stats->average_rating ?? 0,
            'total_reviews' => $stats->total_reviews ?? 0,
        ]);
    }
}
