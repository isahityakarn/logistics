<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LogisticsLoad;
use App\Models\User;

class LogisticsLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::where('user_type', 'driver')->get();
        $statuses = ['pending', 'assigned', 'in_progress', 'picked_up', 'in_transit', 'delivered', 'completed'];
        
        $sampleJobs = [
            [
                'pickup_location' => 'Amazon Warehouse, NYC',
                'pickup_phone' => '+1-555-1001',
                'pickup_company' => 'Amazon Fulfillment',
                'pickup_additional_info' => '1000 Harbor Dr, New York, NY 10001',
                'delivery_location' => 'Customer Address, Brooklyn',
                'delivery_phone' => '+1-555-2001',
                'delivery_company' => 'Residential',
                'delivery_additional_info' => '456 Brooklyn Ave, Brooklyn, NY 11201',
                'job_description' => 'Electronics package delivery',
                'no_of_items' => 2,
                'gross_weight' => 5.5,
                'job_type' => 'pickup_delivery',
                'distance_km' => 25.0,
                'rate_per_km' => 1.80,
            ],
            [
                'pickup_location' => 'UPS Distribution Center',
                'pickup_phone' => '+1-555-1002',
                'pickup_company' => 'UPS',
                'pickup_additional_info' => '2000 Logistics Blvd, Los Angeles, CA 90210',
                'delivery_location' => 'Office Building, Downtown LA',
                'delivery_phone' => '+1-555-2002',
                'delivery_company' => 'TechCorp Inc',
                'delivery_additional_info' => '789 Business St, Los Angeles, CA 90013',
                'job_description' => 'Office supplies and equipment',
                'no_of_items' => 5,
                'gross_weight' => 25.0,
                'job_type' => 'freight',
                'distance_km' => 35.0,
                'rate_per_km' => 2.15,
            ],
            [
                'pickup_location' => 'Medical Facility',
                'pickup_phone' => '+1-555-1003',
                'pickup_company' => 'Chicago Medical Center',
                'pickup_additional_info' => '3000 Health Ave, Chicago, IL 60601',
                'delivery_location' => 'Pharmacy Chain',
                'delivery_phone' => '+1-555-2003',
                'delivery_company' => 'CVS Pharmacy',
                'delivery_additional_info' => '321 Pharmacy Rd, Chicago, IL 60614',
                'job_description' => 'Medical supplies transport',
                'no_of_items' => 3,
                'gross_weight' => 15.0,
                'job_type' => 'courier',
                'distance_km' => 18.0,
                'rate_per_km' => 4.70,
            ],
            [
                'pickup_location' => 'Furniture Store',
                'pickup_phone' => '+1-555-1004',
                'pickup_company' => 'IKEA Houston',
                'pickup_additional_info' => '4000 Furniture Way, Houston, TX 77001',
                'delivery_location' => 'Residential Home',
                'delivery_phone' => '+1-555-2004',
                'delivery_company' => 'Residential',
                'delivery_additional_info' => '654 Home St, Houston, TX 77056',
                'job_description' => 'Furniture delivery and assembly',
                'no_of_items' => 8,
                'gross_weight' => 120.0,
                'job_type' => 'moving',
                'distance_km' => 42.0,
                'rate_per_km' => 3.57,
            ],
            [
                'pickup_location' => 'Food Distribution Center',
                'pickup_phone' => '+1-555-1005',
                'pickup_company' => 'Sysco Foods',
                'pickup_additional_info' => '5000 Food Blvd, Phoenix, AZ 85001',
                'delivery_location' => 'Restaurant Chain',
                'delivery_phone' => '+1-555-2005',
                'delivery_company' => 'Desert Grill',
                'delivery_additional_info' => '987 Restaurant Row, Phoenix, AZ 85014',
                'job_description' => 'Fresh food and produce delivery',
                'no_of_items' => 12,
                'gross_weight' => 85.0,
                'job_type' => 'pickup_delivery',
                'distance_km' => 28.0,
                'rate_per_km' => 3.39,
            ],
            [
                'pickup_location' => 'Auto Parts Store',
                'pickup_phone' => '+1-555-1006',
                'pickup_company' => 'AutoZone',
                'pickup_additional_info' => '6000 Parts Ave, Philadelphia, PA 19101',
                'delivery_location' => 'Auto Repair Shop',
                'delivery_phone' => '+1-555-2006',
                'delivery_company' => 'Quick Fix Garage',
                'delivery_additional_info' => '147 Repair St, Philadelphia, PA 19147',
                'job_description' => 'Auto parts and tools',
                'no_of_items' => 4,
                'gross_weight' => 35.0,
                'job_type' => 'courier',
                'distance_km' => 22.0,
                'rate_per_km' => 2.50,
            ],
            [
                'pickup_location' => 'Fashion Warehouse',
                'pickup_phone' => '+1-555-1007',
                'pickup_company' => 'Fashion Central',
                'pickup_additional_info' => '7000 Style Blvd, San Antonio, TX 78201',
                'delivery_location' => 'Retail Store',
                'delivery_phone' => '+1-555-2007',
                'delivery_company' => 'Trendy Boutique',
                'delivery_additional_info' => '258 Shopping Center, San Antonio, TX 78215',
                'job_description' => 'Clothing and accessories',
                'no_of_items' => 15,
                'gross_weight' => 45.0,
                'job_type' => 'pickup_delivery',
                'distance_km' => 31.0,
                'rate_per_km' => 2.26,
            ],
            [
                'pickup_location' => 'Tech Manufacturer',
                'pickup_phone' => '+1-555-1008',
                'pickup_company' => 'Dell Technologies',
                'pickup_additional_info' => '8000 Tech Park, San Diego, CA 92101',
                'delivery_location' => 'Corporate Office',
                'delivery_phone' => '+1-555-2008',
                'delivery_company' => 'StartUp Inc',
                'delivery_additional_info' => '369 Innovation Dr, San Diego, CA 92121',
                'job_description' => 'Computer equipment and servers',
                'no_of_items' => 6,
                'gross_weight' => 75.0,
                'job_type' => 'freight',
                'distance_km' => 38.0,
                'rate_per_km' => 3.16,
            ],
        ];

        foreach ($sampleJobs as $index => $jobData) {
            // Assign random driver to some jobs
            $driver = rand(0, 1) ? $drivers->random() : null;
            
            // Set status based on whether driver is assigned
            $status = $driver ? $statuses[array_rand($statuses)] : 'pending';
            
            LogisticsLoad::create(array_merge($jobData, [
                'driver_id' => $driver?->id,
                'status' => $status,
                'weight_unit' => 'kg',
                'dimension_unit' => 'cm',
                'currency' => 'USD',
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 15)),
            ]));
        }

        $this->command->info('Successfully created ' . count($sampleJobs) . ' sample logistics jobs!');
    }
}
