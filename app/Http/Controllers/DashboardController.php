<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Load;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LogisticsLoad;

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
        $totalLoads = Load::count();
        $totalBids = Bid::count();
        $totalLoadsCompleted = Load::where('status', 'completed')->count();
       

        $recentUsers = User::orderby('id', 'desc')->latest()->take(5)->get();
        $recentLoad = Load::orderby('id', 'desc')->latest()->take(5)->get();
        $recentBid = Bid::orderby('id', 'desc')->latest()->take(5)->get();
        
        return view('dashboard.admin', compact(
            'totalUsers',
            'totalLoads',
            'totalBids',
            'totalLoadsCompleted',
            'recentUsers',
            'recentLoad',
            'recentBid'
        ));
    }

    public function companyDashboard()
    {
        $user = Auth::user();
        
       $totalUsers = User::count();
        $totalLoads = Load::count();
        $totalBids = Bid::count();
        $totalLoadsCompleted = Load::where('status', 'completed')->count();
       

        $recentUsers = User::orderby('id', 'desc')->latest()->take(5)->get();
        $recentLoad = Load::orderby('id', 'desc')->latest()->take(5)->get();
        $recentBid = Bid::orderby('id', 'desc')->latest()->take(5)->get();
        
        return view('dashboard.admin', compact(
            'totalUsers',
            'totalLoads',
            'totalBids',
            'totalLoadsCompleted',
            'recentUsers',
            'recentLoad',
            'recentBid'
        ));
        
    }

    public function driverDashboard()
    {
        $user = Auth::user();
       $totalUsers = User::count();
        $totalLoads = Load::count();
        $totalBids = Bid::count();
        $totalLoadsCompleted = Load::where('status', 'completed')->count();
       

        $recentUsers = User::orderby('id', 'desc')->latest()->take(5)->get();
        $recentLoad = Load::orderby('id', 'desc')->latest()->take(5)->get();
        $recentBid = Bid::orderby('id', 'desc')->latest()->take(5)->get();
        
        return view('dashboard.admin', compact(
            'totalUsers',
            'totalLoads',
            'totalBids',
            'totalLoadsCompleted',
            'recentUsers',
            'recentLoad',
            'recentBid'
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
