<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ParentDashboardController extends Controller
{
    /**
     * Display the parent dashboard view.
     */
    public function index()
    {
        return Inertia::render('Dashboard/Parent');
    }
}
