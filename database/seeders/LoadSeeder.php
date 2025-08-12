<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Load;

class LoadSeeder extends Seeder
{
    public function run(): void
    {
        $demoLoads = [
            [
                'pickup_location' => 'Mumbai, Maharashtra, India',
                'pickup_latitude' => 19.0760,
                'pickup_longitude' => 72.8777,
                'delivery_location' => 'Pune, Maharashtra, India',
                'delivery_latitude' => 18.5204,
                'delivery_longitude' => 73.8567,
                'status' => 'pending',
            ],
            [
                'pickup_location' => 'Delhi, India',
                'pickup_latitude' => 28.6139,
                'pickup_longitude' => 77.2090,
                'delivery_location' => 'Agra, Uttar Pradesh, India',
                'delivery_latitude' => 27.1767,
                'delivery_longitude' => 78.0081,
                'status' => 'assigned',
            ],
            [
                'pickup_location' => 'Bangalore, Karnataka, India',
                'pickup_latitude' => 12.9716,
                'pickup_longitude' => 77.5946,
                'delivery_location' => 'Chennai, Tamil Nadu, India',
                'delivery_latitude' => 13.0827,
                'delivery_longitude' => 80.2707,
                'status' => 'in_progress',
            ],
            [
                'pickup_location' => 'Ahmedabad, Gujarat, India',
                'pickup_latitude' => 23.0225,
                'pickup_longitude' => 72.5714,
                'delivery_location' => 'Surat, Gujarat, India',
                'delivery_latitude' => 21.1702,
                'delivery_longitude' => 72.8311,
                'status' => 'completed',
            ],
            [
                'pickup_location' => 'Kolkata, West Bengal, India',
                'pickup_latitude' => 22.5726,
                'pickup_longitude' => 88.3639,
                'delivery_location' => 'Patna, Bihar, India',
                'delivery_latitude' => 25.5941,
                'delivery_longitude' => 85.1376,
                'status' => 'delivered',
            ],
        ];

        foreach ($demoLoads as $data) {
            Load::create($data);
        }
    }
}
