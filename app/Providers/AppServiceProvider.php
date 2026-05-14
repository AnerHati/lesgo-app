<?php

namespace App\Providers;

use App\Models\Review;
use App\Models\Schedule;
use App\Observers\ReviewObserver;
use App\Observers\ScheduleObserver;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Review::observe(ReviewObserver::class);
        Schedule::observe(ScheduleObserver::class);
        \App\Models\StudyClass::observe(\App\Observers\StudyClassObserver::class);
    }
}
