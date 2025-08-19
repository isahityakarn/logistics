<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Load;

class MapController extends Controller
{
    public function pickupMap(Request $request)
    {
        // Get loads with pickup coordinates, optionally filtered by pickup and delivery locations
        $pickupLocations = Load::query()
            ->select('pickup_location', 'pickup_latitude', 'pickup_longitude', 'delivery_location')
            ->when($request->filled('pickup_location'), function ($q) use ($request) {
                $q->where('pickup_location', 'like', '%'.trim((string) $request->input('pickup_location')).'%');
            })
            ->when($request->filled('delivery_location'), function ($q) use ($request) {
                $q->where('delivery_location', 'like', '%'.trim((string) $request->input('delivery_location')).'%');
            })
            ->whereNotNull('pickup_latitude')
            ->whereNotNull('pickup_longitude')
            ->get();

        return view('map.pickup_map', [
            'pickupLocations' => $pickupLocations,
        ]);
    }
}
