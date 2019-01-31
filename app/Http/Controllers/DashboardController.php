<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     */
    public function __invoke()
    {
        $locations = Location::get();
        return view('dashboard', compact('locations'));
    }
}
