<?php

// File: app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the application dashboard or homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Dashboard');
    }
}
