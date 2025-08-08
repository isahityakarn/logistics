<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Demo Admin User
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@gmail.com',
            'phone' => '+1-555-0001',
            'address' => '1 Admin Plaza, Corporate City, NY 10001',
            'company_name' => 'Logistics Platform Admin',
            'user_type' => 'admin',
            'password' => Hash::make('admin@gmail.com'),
            'email_verified_at' => now(),
        ]);

        // Create Easy Demo Users for Testing
        User::create([
            'name' => 'Demo Driver',
            'email' => 'driver@gmail.com',
            'phone' => '+1-555-1111',
            'address' => '123 Driver Street, Demo City, CA 90210',
            'license_number' => 'DL-DEMO-001',
            'company_name' => 'Demo Driver Services',
            'user_type' => 'driver',
            'password' => Hash::make('driver@gmail.com'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Demo Company',
            'email' => 'company@gmail.com',
            'phone' => '+1-555-2222',
            'address' => '456 Company Boulevard, Demo City, CA 90210',
            'company_name' => 'Demo Logistics Company',
            'user_type' => 'company',
            'password' => Hash::make('company@gmail.com'),
            'email_verified_at' => now(),
        ]);

        // Create 10 Driver Users
        $drivers = [
            [
                'name' => 'John Miller',
                'email' => 'john.miller@driver.com',
                'phone' => '+1-555-0101',
                'address' => '123 Main St, New York, NY 10001',
                'license_number' => 'DL12345678',
                'company_name' => 'Independent Driver',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@driver.com',
                'phone' => '+1-555-0102',
                'address' => '456 Oak Ave, Los Angeles, CA 90210',
                'license_number' => 'DL23456789',
                'company_name' => 'Quick Transport LLC',
            ],
            [
                'name' => 'Michael Rodriguez',
                'email' => 'michael.rodriguez@driver.com',
                'phone' => '+1-555-0103',
                'address' => '789 Pine St, Chicago, IL 60601',
                'license_number' => 'DL34567890',
                'company_name' => 'Rodriguez Logistics',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@driver.com',
                'phone' => '+1-555-0104',
                'address' => '321 Elm St, Houston, TX 77001',
                'license_number' => 'DL45678901',
                'company_name' => 'Swift Delivery Services',
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@driver.com',
                'phone' => '+1-555-0105',
                'address' => '654 Maple Dr, Phoenix, AZ 85001',
                'license_number' => 'DL56789012',
                'company_name' => 'Desert Express',
            ],
            [
                'name' => 'Lisa Thompson',
                'email' => 'lisa.thompson@driver.com',
                'phone' => '+1-555-0106',
                'address' => '987 Cedar Ln, Philadelphia, PA 19101',
                'license_number' => 'DL67890123',
                'company_name' => 'Liberty Logistics',
            ],
            [
                'name' => 'Robert Garcia',
                'email' => 'robert.garcia@driver.com',
                'phone' => '+1-555-0107',
                'address' => '147 Birch Rd, San Antonio, TX 78201',
                'license_number' => 'DL78901234',
                'company_name' => 'Lone Star Transport',
            ],
            [
                'name' => 'Amanda Brown',
                'email' => 'amanda.brown@driver.com',
                'phone' => '+1-555-0108',
                'address' => '258 Spruce Way, San Diego, CA 92101',
                'license_number' => 'DL89012345',
                'company_name' => 'Pacific Coast Delivery',
            ],
            [
                'name' => 'James Anderson',
                'email' => 'james.anderson@driver.com',
                'phone' => '+1-555-0109',
                'address' => '369 Willow St, Dallas, TX 75201',
                'license_number' => 'DL90123456',
                'company_name' => 'Big D Transport',
            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.martinez@driver.com',
                'phone' => '+1-555-0110',
                'address' => '741 Aspen Blvd, San Jose, CA 95101',
                'license_number' => 'DL01234567',
                'company_name' => 'Silicon Valley Express',
            ],
        ];

        foreach ($drivers as $driver) {
            User::create([
                'name' => $driver['name'],
                'email' => $driver['email'],
                'phone' => $driver['phone'],
                'address' => $driver['address'],
                'license_number' => $driver['license_number'],
                'company_name' => $driver['company_name'],
                'user_type' => 'driver',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
        }

        // Create 10 Company Users
        $companies = [
            [
                'name' => 'Mark Stevens',
                'email' => 'contact@globallogistics.com',
                'phone' => '+1-555-0201',
                'address' => '100 Business Park Dr, Atlanta, GA 30301',
                'company_name' => 'Global Logistics Solutions',
            ],
            [
                'name' => 'Rachel Cooper',
                'email' => 'info@expeditefreight.com',
                'phone' => '+1-555-0202',
                'address' => '250 Industrial Blvd, Detroit, MI 48201',
                'company_name' => 'Expedite Freight Services',
            ],
            [
                'name' => 'Thomas Kim',
                'email' => 'hello@metrotransport.com',
                'phone' => '+1-555-0203',
                'address' => '375 Commerce St, Boston, MA 02101',
                'company_name' => 'Metro Transport Group',
            ],
            [
                'name' => 'Nicole Parker',
                'email' => 'support@reliabledelivery.com',
                'phone' => '+1-555-0204',
                'address' => '500 Logistics Way, Memphis, TN 38101',
                'company_name' => 'Reliable Delivery Network',
            ],
            [
                'name' => 'Kevin Lee',
                'email' => 'admin@primelogistics.com',
                'phone' => '+1-555-0205',
                'address' => '625 Shipping Ln, Jacksonville, FL 32201',
                'company_name' => 'Prime Logistics Corp',
            ],
            [
                'name' => 'Stephanie White',
                'email' => 'office@unitedfreight.com',
                'phone' => '+1-555-0206',
                'address' => '750 Transport Ave, Columbus, OH 43201',
                'company_name' => 'United Freight Solutions',
            ],
            [
                'name' => 'Daniel Turner',
                'email' => 'contact@fasttrack.com',
                'phone' => '+1-555-0207',
                'address' => '875 Express Rd, Charlotte, NC 28201',
                'company_name' => 'FastTrack Logistics',
            ],
            [
                'name' => 'Maria Gonzalez',
                'email' => 'info@coastalcargo.com',
                'phone' => '+1-555-0208',
                'address' => '1000 Harbor Dr, Seattle, WA 98101',
                'company_name' => 'Coastal Cargo Services',
            ],
            [
                'name' => 'Christopher Hall',
                'email' => 'hello@swiftcourier.com',
                'phone' => '+1-555-0209',
                'address' => '1125 Delivery St, Denver, CO 80201',
                'company_name' => 'Swift Courier Express',
            ],
            [
                'name' => 'Lauren Adams',
                'email' => 'contact@nationwideshipping.com',
                'phone' => '+1-555-0210',
                'address' => '1250 Distribution Pkwy, Nashville, TN 37201',
                'company_name' => 'Nationwide Shipping Co',
            ],
        ];

        foreach ($companies as $company) {
            User::create([
                'name' => $company['name'],
                'email' => $company['email'],
                'phone' => $company['phone'],
                'address' => $company['address'],
                'company_name' => $company['company_name'],
                'user_type' => 'company',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
        }

        $this->command->info('Successfully created 1 admin, 13 drivers and 10 companies (24 total users)!');
    }
}
