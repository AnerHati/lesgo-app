<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        $unreadSendersCount = 0;

        if ($user) {
            $unreadSendersCount = \App\Models\Message::where('receiver_id', $user->id)
                ->where('is_read', false)
                ->distinct('sender_id')
                ->count('sender_id');
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
            ],
            'unreadSendersCount' => $unreadSendersCount,
            'status' => session('status'),
        ];
    }
}
