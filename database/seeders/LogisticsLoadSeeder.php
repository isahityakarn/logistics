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
        $companies = User::where('user_type', 'company')->get();
        $statuses = ['pending', 'assigned', 'in_progress', 'picked_up', 'in_transit', 'delivered', 'completed'];
        
        $sampleLoads = [
            [
                'pickup_location' => 'Amazon Warehouse, 1000 Harbor Dr, New York, NY 10001',
                'pickup_phone' => '+1-555-1001',
                'pickup_company' => 'Amazon Fulfillment',
                'pickup_additional_info' => 'Use loading dock B, contact supervisor John',
                'pickup_latitude' => 40.7589,
                'pickup_longitude' => -73.9851,
                'pickup_date_time_from' => now()->addDays(1)->setHour(8),
                'pickup_date_time_to' => now()->addDays(1)->setHour(12),
                'pickup_info' => 'Morning pickup preferred',
                
                'delivery_location' => '456 Brooklyn Ave, Brooklyn, NY 11201',
                'delivery_phone' => '+1-555-2001',
                'delivery_company' => 'Tech Solutions Inc',
                'delivery_additional_info' => 'Office building, 5th floor reception',
                'delivery_latitude' => 40.6892,
                'delivery_longitude' => -73.9442,
                'delivery_date_time_from' => now()->addDays(1)->setHour(14),
                'delivery_date_time_to' => now()->addDays(1)->setHour(18),
                'delivery_info' => 'Business hours delivery only',
                
                'job_description' => 'Electronics package delivery - laptops and accessories',
                'suggested_vehicle' => 'Van',
                'packaging' => 'Cardboard boxes with fragile stickers',
                'no_of_items' => 5,
                'gross_weight' => 25.50,
                'body_type' => 'Dry Van',
                'job_type' => 'pickup_delivery',
                
                'length' => 120.00,
                'width' => 80.00,
                'height' => 60.00,
                
                'notes' => 'Handle with care - fragile electronics',
                'document_name' => 'delivery_receipt_001.pdf',
                
                'distance_km' => 25.30,
                'distance_miles' => 15.72,
                'rate_per_km' => 2.50,
                'rate_per_mile' => 4.02,
            ],
            [
                'pickup_location' => '2000 Logistics Blvd, Los Angeles, CA 90210',
                'pickup_phone' => '+1-555-1002',
                'pickup_company' => 'UPS Distribution Center',
                'pickup_additional_info' => 'Gate 5, show ID and delivery slip',
                'pickup_latitude' => 34.0522,
                'pickup_longitude' => -118.2437,
                'pickup_date_time_from' => now()->addDays(2)->setHour(6),
                'pickup_date_time_to' => now()->addDays(2)->setHour(10),
                'pickup_info' => 'Early morning pickup required',
                
                'delivery_location' => '789 Business St, Los Angeles, CA 90013',
                'delivery_phone' => '+1-555-2002',
                'delivery_company' => 'TechCorp Inc',
                'delivery_additional_info' => 'Loading dock at rear of building',
                'delivery_latitude' => 34.0407,
                'delivery_longitude' => -118.2468,
                'delivery_date_time_from' => now()->addDays(2)->setHour(13),
                'delivery_date_time_to' => now()->addDays(2)->setHour(17),
                'delivery_info' => 'Signature required from IT department',
                
                'job_description' => 'Office supplies and computer equipment',
                'suggested_vehicle' => 'Box Truck',
                'packaging' => 'Palletized cargo',
                'no_of_items' => 15,
                'gross_weight' => 250.00,
                'body_type' => 'Box Truck',
                'job_type' => 'freight',
                
                'length' => 200.00,
                'width' => 150.00,
                'height' => 180.00,
                
                'notes' => 'Heavy items - forklift required at destination',
                'document_name' => 'freight_manifest_002.pdf',
                
                'distance_km' => 35.80,
                'distance_miles' => 22.24,
                'rate_per_km' => 3.25,
                'rate_per_mile' => 5.23,
            ],
            [
                'pickup_location' => '3000 Health Ave, Chicago, IL 60601',
                'pickup_phone' => '+1-555-1003',
                'pickup_company' => 'Chicago Medical Center',
                'pickup_additional_info' => 'Medical supply loading area, temperature controlled',
                'pickup_latitude' => 41.8781,
                'pickup_longitude' => -87.6298,
                'pickup_date_time_from' => now()->addDays(1)->setHour(10),
                'pickup_date_time_to' => now()->addDays(1)->setHour(14),
                'pickup_info' => 'Temperature sensitive - refrigerated transport needed',
                
                'delivery_location' => '321 Pharmacy Rd, Chicago, IL 60614',
                'delivery_phone' => '+1-555-2003',
                'delivery_company' => 'CVS Pharmacy',
                'delivery_additional_info' => 'Pharmacy receiving dock, pharmacist signature required',
                'delivery_latitude' => 41.9250,
                'delivery_longitude' => -87.6562,
                'delivery_date_time_from' => now()->addDays(1)->setHour(16),
                'delivery_date_time_to' => now()->addDays(1)->setHour(20),
                'delivery_info' => 'Pharmacist must be present for delivery',
                
                'job_description' => 'Medical supplies and pharmaceuticals',
                'suggested_vehicle' => 'Refrigerated Van',
                'packaging' => 'Insulated medical containers',
                'no_of_items' => 8,
                'gross_weight' => 45.75,
                'body_type' => 'Refrigerated',
                'job_type' => 'courier',
                
                'length' => 90.00,
                'width' => 60.00,
                'height' => 40.00,
                
                'notes' => 'URGENT: Temperature must remain 2-8°C throughout transport',
                'document_name' => 'medical_transport_003.pdf',
                
                'distance_km' => 18.50,
                'distance_miles' => 11.49,
                'rate_per_km' => 6.50,
                'rate_per_mile' => 10.46,
            ],
            [
                'pickup_location' => '4000 Furniture Way, Houston, TX 77001',
                'pickup_phone' => '+1-555-1004',
                'pickup_company' => 'IKEA Houston',
                'pickup_additional_info' => 'Customer pickup area, furniture assembly team available',
                'pickup_latitude' => 29.7604,
                'pickup_longitude' => -95.3698,
                'pickup_date_time_from' => now()->addDays(3)->setHour(9),
                'pickup_date_time_to' => now()->addDays(3)->setHour(15),
                'pickup_info' => 'Large furniture pieces - disassembled for transport',
                
                'delivery_location' => '654 Home St, Houston, TX 77056',
                'delivery_phone' => '+1-555-2004',
                'delivery_company' => 'Residential Customer',
                'delivery_additional_info' => 'Single family home, narrow driveway',
                'delivery_latitude' => 29.7633,
                'delivery_longitude' => -95.4618,
                'delivery_date_time_from' => now()->addDays(3)->setHour(16),
                'delivery_date_time_to' => now()->addDays(3)->setHour(20),
                'delivery_info' => 'Assembly required - customer will assist',
                
                'job_description' => 'Furniture delivery and assembly service',
                'suggested_vehicle' => 'Moving Truck',
                'packaging' => 'Furniture blankets and protective wrapping',
                'no_of_items' => 12,
                'gross_weight' => 350.00,
                'body_type' => 'Moving Van',
                'job_type' => 'moving',
                
                'length' => 300.00,
                'width' => 200.00,
                'height' => 180.00,
                
                'notes' => 'Assembly tools provided - estimated 2-3 hours assembly time',
                'document_name' => 'furniture_delivery_004.pdf',
                
                'distance_km' => 42.30,
                'distance_miles' => 26.28,
                'rate_per_km' => 4.75,
                'rate_per_mile' => 7.64,
            ],
            [
                'pickup_location' => '5000 Food Blvd, Phoenix, AZ 85001',
                'pickup_phone' => '+1-555-1005',
                'pickup_company' => 'Sysco Foods Distribution',
                'pickup_additional_info' => 'Cold storage facility, food safety protocols required',
                'pickup_latitude' => 33.4484,
                'pickup_longitude' => -112.0740,
                'pickup_date_time_from' => now()->addDays(1)->setHour(5),
                'pickup_date_time_to' => now()->addDays(1)->setHour(8),
                'pickup_info' => 'Early morning pickup for fresh delivery',
                
                'delivery_location' => '987 Restaurant Row, Phoenix, AZ 85014',
                'delivery_phone' => '+1-555-2005',
                'delivery_company' => 'Desert Grill Restaurant',
                'delivery_additional_info' => 'Kitchen receiving area, chef must inspect',
                'delivery_latitude' => 33.5224,
                'delivery_longitude' => -112.0740,
                'delivery_date_time_from' => now()->addDays(1)->setHour(9),
                'delivery_date_time_to' => now()->addDays(1)->setHour(11),
                'delivery_info' => 'Fresh ingredients for lunch prep',
                
                'job_description' => 'Fresh food and produce delivery',
                'suggested_vehicle' => 'Refrigerated Truck',
                'packaging' => 'Insulated containers and ice packs',
                'no_of_items' => 25,
                'gross_weight' => 185.50,
                'body_type' => 'Refrigerated',
                'job_type' => 'pickup_delivery',
                
                'length' => 180.00,
                'width' => 120.00,
                'height' => 100.00,
                
                'notes' => 'Food safety certification required - maintain cold chain',
                'document_name' => 'food_delivery_005.pdf',
                
                'distance_km' => 28.70,
                'distance_miles' => 17.84,
                'rate_per_km' => 5.25,
                'rate_per_mile' => 8.45,
            ],
        ];

        foreach ($sampleLoads as $index => $loadData) {
            // Assign random company to some loads
            $company = $companies->isNotEmpty() ? $companies->random() : null;
            
            // Set random status
            $status = $statuses[array_rand($statuses)];
            $assigned_at = $status !== 'pending' ? now()->subDays(rand(1, 5)) : null;
            $completed_at = in_array($status, ['delivered', 'completed']) ? now()->subDays(rand(0, 3)) : null;
            
            LogisticsLoad::create(array_merge($loadData, [
                'company_id' => $company?->id,
                'status' => $status,
                'weight_unit' => 'kg',
                'dimension_unit' => 'cm',
                'currency' => 'USD',
                'assigned_at' => $assigned_at,
                'completed_at' => $completed_at,
                'created_at' => now()->subDays(rand(1, 15)),
                'updated_at' => now()->subDays(rand(0, 7)),
            ]));
        }

        // Create additional random loads for variety
        for ($i = 0; $i < 25; $i++) {
            $company = $companies->isNotEmpty() ? $companies->random() : null;
            $status = $statuses[array_rand($statuses)];
            
            // Define some realistic load types and scenarios
            $loadTypes = [
                [
                    'type' => 'Electronics',
                    'description' => 'Electronic equipment and components',
                    'weight_range' => [5, 100],
                    'rate_range' => [2.5, 6.0],
                    'vehicle' => 'Van',
                    'body_type' => 'Dry Van',
                    'job_type' => 'pickup_delivery'
                ],
                [
                    'type' => 'Medical Supplies',
                    'description' => 'Medical equipment and pharmaceuticals',
                    'weight_range' => [10, 50],
                    'rate_range' => [5.0, 12.0],
                    'vehicle' => 'Refrigerated Van',
                    'body_type' => 'Refrigerated',
                    'job_type' => 'courier'
                ],
                [
                    'type' => 'Food & Beverages',
                    'description' => 'Fresh and packaged food products',
                    'weight_range' => [50, 300],
                    'rate_range' => [3.0, 8.0],
                    'vehicle' => 'Refrigerated Truck',
                    'body_type' => 'Refrigerated',
                    'job_type' => 'pickup_delivery'
                ],
                [
                    'type' => 'Furniture',
                    'description' => 'Household and office furniture',
                    'weight_range' => [100, 800],
                    'rate_range' => [4.0, 10.0],
                    'vehicle' => 'Moving Truck',
                    'body_type' => 'Moving Van',
                    'job_type' => 'moving'
                ],
                [
                    'type' => 'Construction Materials',
                    'description' => 'Building supplies and equipment',
                    'weight_range' => [200, 1000],
                    'rate_range' => [3.5, 7.5],
                    'vehicle' => 'Flatbed Truck',
                    'body_type' => 'Flatbed',
                    'job_type' => 'freight'
                ],
                [
                    'type' => 'Automotive Parts',
                    'description' => 'Vehicle parts and accessories',
                    'weight_range' => [20, 150],
                    'rate_range' => [2.8, 5.5],
                    'vehicle' => 'Box Truck',
                    'body_type' => 'Box Truck',
                    'job_type' => 'courier'
                ],
                [
                    'type' => 'Documents',
                    'description' => 'Important business documents',
                    'weight_range' => [1, 10],
                    'rate_range' => [8.0, 15.0],
                    'vehicle' => 'Motorcycle',
                    'body_type' => 'Courier Bag',
                    'job_type' => 'courier'
                ]
            ];
            
            $loadType = $loadTypes[array_rand($loadTypes)];
            $weight = fake()->randomFloat(2, $loadType['weight_range'][0], $loadType['weight_range'][1]);
            $distance = fake()->randomFloat(2, 10, 200);
            $rate = fake()->randomFloat(2, $loadType['rate_range'][0], $loadType['rate_range'][1]);
            
            // Generate realistic city pairs
            $cities = [
                ['New York, NY', 40.7128, -74.0060],
                ['Los Angeles, CA', 34.0522, -118.2437],
                ['Chicago, IL', 41.8781, -87.6298],
                ['Houston, TX', 29.7604, -95.3698],
                ['Phoenix, AZ', 33.4484, -112.0740],
                ['Philadelphia, PA', 39.9526, -75.1652],
                ['San Antonio, TX', 29.4241, -98.4936],
                ['San Diego, CA', 32.7157, -117.1611],
                ['Dallas, TX', 32.7767, -96.7970],
                ['San Jose, CA', 37.3382, -121.8863],
                ['Austin, TX', 30.2672, -97.7431],
                ['Jacksonville, FL', 30.3322, -81.6557],
                ['Fort Worth, TX', 32.7555, -97.3308],
                ['Columbus, OH', 39.9612, -82.9988],
                ['Charlotte, NC', 35.2271, -80.8431],
                ['Seattle, WA', 47.6062, -122.3321],
                ['Denver, CO', 39.7392, -104.9903],
                ['Boston, MA', 42.3601, -71.0589],
                ['El Paso, TX', 31.7619, -106.4850],
                ['Detroit, MI', 42.3314, -83.0458],
                ['Nashville, TN', 36.1627, -86.7816],
                ['Memphis, TN', 35.1495, -90.0490],
                ['Portland, OR', 45.5152, -122.6784],
                ['Oklahoma City, OK', 35.4676, -97.5164],
                ['Las Vegas, NV', 36.1699, -115.1398]
            ];
            
            $pickupCity = $cities[array_rand($cities)];
            $deliveryCity = $cities[array_rand($cities)];
            
            // Ensure pickup and delivery are different cities
            while ($deliveryCity[0] === $pickupCity[0]) {
                $deliveryCity = $cities[array_rand($cities)];
            }
            
            LogisticsLoad::create([
                'company_id' => $company?->id,
                'pickup_location' => fake()->streetAddress() . ', ' . $pickupCity[0],
                'pickup_phone' => fake()->phoneNumber(),
                'pickup_company' => fake()->company(),
                'pickup_additional_info' => fake()->sentence(),
                'pickup_latitude' => $pickupCity[1] + fake()->randomFloat(4, -0.1, 0.1),
                'pickup_longitude' => $pickupCity[2] + fake()->randomFloat(4, -0.1, 0.1),
                'pickup_date_time_from' => fake()->dateTimeBetween('now', '+7 days'),
                'pickup_date_time_to' => fake()->dateTimeBetween('+1 day', '+7 days'),
                'pickup_info' => fake()->sentence(),
                
                'delivery_location' => fake()->streetAddress() . ', ' . $deliveryCity[0],
                'delivery_phone' => fake()->phoneNumber(),
                'delivery_company' => fake()->company(),
                'delivery_additional_info' => fake()->sentence(),
                'delivery_latitude' => $deliveryCity[1] + fake()->randomFloat(4, -0.1, 0.1),
                'delivery_longitude' => $deliveryCity[2] + fake()->randomFloat(4, -0.1, 0.1),
                'delivery_date_time_from' => fake()->dateTimeBetween('+1 day', '+8 days'),
                'delivery_date_time_to' => fake()->dateTimeBetween('+2 days', '+8 days'),
                'delivery_info' => fake()->sentence(),
                
                'job_description' => $loadType['description'] . ' - ' . fake()->sentence(4),
                'suggested_vehicle' => $loadType['vehicle'],
                'packaging' => fake()->randomElement(['Boxes', 'Pallets', 'Containers', 'Bags', 'Crates', 'Wrapped']),
                'no_of_items' => fake()->numberBetween(1, 25),
                'gross_weight' => $weight,
                'weight_unit' => 'kg',
                'body_type' => $loadType['body_type'],
                'job_type' => $loadType['job_type'],
                
                'length' => fake()->randomFloat(2, 50, 400),
                'width' => fake()->randomFloat(2, 50, 250),
                'height' => fake()->randomFloat(2, 30, 200),
                'dimension_unit' => 'cm',
                
                'notes' => $this->generateRealisticNotes($loadType['type']),
                'document_name' => 'load_' . ($i + 6) . '_' . strtolower(str_replace(' ', '_', $loadType['type'])) . '.pdf',
                
                'distance_km' => $distance,
                'distance_miles' => $distance * 0.621371,
                'rate_per_km' => $rate,
                'rate_per_mile' => $rate * 1.60934,
                'currency' => fake()->randomElement(['USD', 'EUR', 'CAD', 'GBP']),
                
                'status' => $status,
                'assigned_at' => $status !== 'pending' ? fake()->dateTimeBetween('-5 days', 'now') : null,
                'completed_at' => in_array($status, ['delivered', 'completed']) ? fake()->dateTimeBetween('-3 days', 'now') : null,
                
                'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
                'updated_at' => fake()->dateTimeBetween('-15 days', 'now'),
            ]);
        }

        $this->command->info('Successfully created ' . (count($sampleLoads) + 25) . ' sample logistics loads!');
    }

    /**
     * Generate realistic notes based on load type
     */
    private function generateRealisticNotes($loadType): string
    {
        $notes = [
            'Electronics' => [
                'Handle with care - fragile electronics',
                'Keep dry and avoid extreme temperatures',
                'Signature required upon delivery',
                'High-value cargo - secure transport required',
                'Anti-static packaging used'
            ],
            'Medical Supplies' => [
                'Temperature sensitive - maintain cold chain',
                'Medical certification required',
                'Priority delivery - time critical',
                'Pharmacist signature required',
                'Sterile packaging - do not contaminate'
            ],
            'Food & Beverages' => [
                'Perishable goods - refrigerated transport',
                'Food safety protocols must be followed',
                'Health department certified driver required',
                'First in, first out delivery priority',
                'Temperature monitoring required'
            ],
            'Furniture' => [
                'Assembly instructions included',
                'Protective wrapping applied',
                'Heavy lifting equipment may be needed',
                'Customer assistance available',
                'Check for damage before unloading'
            ],
            'Construction Materials' => [
                'Heavy load - use proper lifting equipment',
                'Safety equipment required',
                'Delivery to construction site',
                'Site supervisor contact required',
                'Weather protection needed'
            ],
            'Automotive Parts' => [
                'OEM certified parts',
                'Warranty valid with proper handling',
                'Technical documentation included',
                'Installation instructions provided',
                'Return packaging required'
            ],
            'Documents' => [
                'Confidential materials - secure handling',
                'Signature confirmation required',
                'Time-sensitive delivery',
                'Legal documents enclosed',
                'Chain of custody maintained'
            ]
        ];

        $typeNotes = $notes[$loadType] ?? ['Standard cargo handling required'];
        return $typeNotes[array_rand($typeNotes)] . '. ' . fake()->sentence();
    }
}
