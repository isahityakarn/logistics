<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LogisticsJob;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        
        switch ($user->user_type) {
            case 'admin':
                return $this->adminDashboard();
            case 'company':
                return $this->companyDashboard();
            case 'driver':
                return $this->driverDashboard();
            default:
                return view('dashboard.general');
        }
    }

    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalCompanies = User::where('user_type', 'company')->count();
        $totalDrivers = User::where('user_type', 'driver')->count();
        $totalAdmins = User::where('user_type', 'admin')->count();
        $recentUsers = User::latest()->take(5)->get();
        
        return view('dashboard.admin', compact(
            'totalUsers',
            'totalCompanies',
            'totalDrivers',
            'totalAdmins',
            'recentUsers'
        ));
    }

    public function companyDashboard()
    {
        $user = Auth::user();
        
        // Static numbers for company dashboard
        $totalJobs = 125;
        $pendingJobs = 23;
        $inTransitJobs = 47;
        $completedJobs = 55;
        
        // Get recent jobs (all jobs for now since company_id doesn't exist)
        $recentJobs = LogisticsJob::latest()->take(5)->get();
        
        return view('dashboard.company', compact(
            'totalJobs',
            'pendingJobs',
            'inTransitJobs',
            'completedJobs',
            'recentJobs'
        ));
    }

    public function driverDashboard()
    {
        $user = Auth::user();
        $availableJobsCount = LogisticsJob::where('status', 'pending')->count();
        $assignedJobsCount = LogisticsJob::where('driver_id', $user->id)
            ->whereIn('status', ['assigned', 'in_progress', 'picked_up', 'in_transit'])
            ->count();
        $completedJobsCount = LogisticsJob::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $totalEarnings = 1000;
        $availableJobs = LogisticsJob::with('driver')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboard.driver', compact(
            'availableJobsCount',
            'assignedJobsCount', 
            'completedJobsCount',
            'totalEarnings',
            'availableJobs'
        ));
    }

    public function listDrivers()
    {
        $drivers = User::where('user_type', 'driver')
            ->withCount([
                'assignedJobs as total_jobs' => function ($query) {
                    // Count all jobs assigned to this driver
                },
                'assignedJobs as completed_jobs' => function ($query) {
                    $query->where('status', 'completed');
                },
                'assignedJobs as active_jobs' => function ($query) {
                    $query->whereIn('status', ['assigned', 'in_progress', 'picked_up', 'in_transit']);
                }
            ])
            ->latest()
            ->paginate(15);

        return view('admin.drivers', compact('drivers'));
    }

    public function listCompanies()
    {
        $companies = User::where('user_type', 'company')
            ->latest()
            ->paginate(15);

        return view('admin.companies', compact('companies'));
    }
}
