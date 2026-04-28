<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class TutorDashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard/Tutor/Index');
    }
}
