<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

abstract class Controller
{
   public function getDistance($pickup_location, $delivery_location)
    {
        $apiKey = env('APIKEY');

        $response = Http::get('https://api.distancematrix.ai/maps/api/distancematrix/json', [
            'origins'      => $pickup_location,
            'destinations' => $delivery_location,
            'key'          => $apiKey
        ]);

        if ($response->successful()) {
            $data = $response->json();

            $distance = $data['rows'][0]['elements'][0]['distance']['text'] ?? null;
            $duration = $data['rows'][0]['elements'][0]['duration']['text'] ?? null;

             return [
                'distance' => $distance,
                'duration' => $duration
            ];
        }

        return response()->json([
            'error'  => 'API request failed',
            'status' => $response->status()
        ], $response->status());
    }
}
