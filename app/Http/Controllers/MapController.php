<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Load;

class MapController extends Controller
{
    public function pickupMap()
    {
        // Get all loads where pickup latitude and longitude are missing
            // Get all loads with pickup latitude and longitude
            $pickupLocations = Load::select('pickup_location', 'pickup_latitude', 'pickup_longitude')
                ->whereNotNull('pickup_latitude')
                ->whereNotNull('pickup_longitude')
                ->get();

            // dd($pickupLocations); // Debugging line to check the data
        return view('map.pickup_map', compact('pickupLocations'));
    }
}
