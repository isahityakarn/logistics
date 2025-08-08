<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoadBid;
use App\Models\LogisticsLoad;
use App\Models\User;

class LoadBidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::where('user_type', 'driver')->get();
        $logisticsLoads = LogisticsLoad::all();

        if ($drivers->count() > 0 && $logisticsLoads->count() > 0) {
            $bidStatuses = ['pending', 'assigned', 'in_progress', 'picked_up', 'in_transit', 'delivered', 'completed', 'cancelled'];
            
            // Create specific demo bids for the first 10 loads
            foreach ($logisticsLoads->take(10) as $load) {
                // Create 2-4 bids per load from different drivers
                $numBids = fake()->numberBetween(2, 4);
                $selectedDrivers = $drivers->shuffle()->take($numBids);
                
                foreach ($selectedDrivers as $index => $driver) {
                    // Set bid price with realistic range based on load type
                    $bidPrice = fake()->randomFloat(2, 150, 800);
                    
                    // First bid might be assigned/in progress, others mostly pending
                    $status = 'pending';
                    if ($index === 0 && fake()->boolean(40)) {
                        $status = fake()->randomElement(['assigned', 'in_progress', 'picked_up', 'in_transit', 'delivered', 'completed']);
                    } else if (fake()->boolean(10)) {
                        $status = 'cancelled';
                    }
                    
                    LoadBid::create([
                        'logisticjob_id' => $load->id,
                        'driver_id' => $driver->id,
                        'price' => $bidPrice,
                        'status' => $status,
                        'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
                        'updated_at' => fake()->dateTimeBetween('-30 days', 'now'),
                    ]);
                }
            }
            
            // Create additional random bids for remaining loads
            foreach ($logisticsLoads->skip(10)->take(15) as $load) {
                // Some loads might have no bids, some might have 1-2
                if (fake()->boolean(70)) {
                    $numBids = fake()->numberBetween(1, 2);
                    $selectedDrivers = $drivers->shuffle()->take($numBids);
                    
                    foreach ($selectedDrivers as $driver) {
                        $bidPrice = fake()->randomFloat(2, 100, 600);
                        
                        LoadBid::create([
                            'logisticjob_id' => $load->id,
                            'driver_id' => $driver->id,
                            'price' => $bidPrice,
                            'status' => fake()->randomElement(['pending', 'pending', 'pending', 'cancelled']), // Mostly pending
                            'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
                            'updated_at' => fake()->dateTimeBetween('-30 days', 'now'),
                        ]);
                    }
                }
            }
            
            echo "Successfully created load bids with various statuses!\n";
        } else {
            echo "Warning: No drivers or logistics loads found. Please run UsersSeeder and LogisticsLoadSeeder first.\n";
        }
    }
}
