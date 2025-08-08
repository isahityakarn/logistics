<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LogisticsJobPrice;
use App\Models\LogisticsJob;
use App\Models\User;

class LogisticsJobPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = User::where('user_type', 'company')->get();
        $logisticsJobs = LogisticsJob::all();

        if ($companies->count() > 0 && $logisticsJobs->count() > 0) {
            foreach ($logisticsJobs->take(5) as $job) {
                foreach ($companies->take(3) as $company) {
                    LogisticsJobPrice::create([
                        'logisticjob_id' => $job->id,
                        'company_id' => $company->id,
                        'price' => fake()->randomFloat(2, 50, 500)
                    ]);
                }
            }
        }
    }
}
