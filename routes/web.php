<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoadBidController;
use App\Http\Controllers\LogisticsLoadController;
use App\Http\Controllers\LoadController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/drivers', [DashboardController::class, 'listDrivers'])->name('admin.drivers');
    Route::get('/companies', [DashboardController::class, 'listCompanies'])->name('admin.companies');
    
    // Logistics Load Routes for Admin
  
});

// Company Routes
Route::prefix('company')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'companyDashboard'])->name('company.dashboard');
  
});

// Driver Routes
Route::prefix('driver')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'driverDashboard'])->name('driver.dashboard');
    
});

Route::resource('loads', LoadController::class)->middleware('auth');
    



