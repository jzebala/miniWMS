<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::paginate(9);

        return view('location.index', compact('locations'));
    }

    public function show($id)
    {
        $location = Location::findOrFail($id);

        return view('location.show', compact('location'));
    }
}
