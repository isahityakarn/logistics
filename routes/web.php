<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoadBidController;
use App\Http\Controllers\LogisticsLoadController;

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
    Route::resource('logistics-load', LogisticsLoadController::class)->names([
        'index' => 'admin.logistics-load.index',
        'create' => 'admin.logistics-load.create',
        'store' => 'admin.logistics-load.store',
        'show' => 'admin.logistics-load.show',
        'edit' => 'admin.logistics-load.edit',
        'update' => 'admin.logistics-load.update',
        'destroy' => 'admin.logistics-load.destroy'
    ]);
    Route::post('/logistics-load/{logisticsLoad}/assign-driver', [LogisticsLoadController::class, 'assignDriver'])->name('admin.logistics-load.assign-driver');
    Route::patch('/logistics-load/{logisticsLoad}/update-status', [LogisticsLoadController::class, 'updateStatus'])->name('admin.logistics-load.update-status');
});

// Company Routes
Route::prefix('company')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'companyDashboard'])->name('company.dashboard');
    
    // Logistics Load Routes for Company
    Route::resource('logistics-load', LogisticsLoadController::class)->names([
        'index' => 'company.logistics-load.index',
        'create' => 'company.logistics-load.create',
        'store' => 'company.logistics-load.store',
        'show' => 'company.logistics-load.show',
        'edit' => 'company.logistics-load.edit',
        'update' => 'company.logistics-load.update',
        'destroy' => 'company.logistics-load.destroy'
    ]);
    Route::patch('/logistics-load/{logisticsLoad}/update-status', [LogisticsLoadController::class, 'updateStatus'])->name('company.logistics-load.update-status');
});

// Driver Routes
Route::prefix('driver')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'driverDashboard'])->name('driver.dashboard');
    
    // Logistics Load Routes for Driver (read-only mostly)
    Route::resource('logistics-load', LogisticsLoadController::class)->names([
        'index' => 'driver.logistics-load.index',
        'show' => 'driver.logistics-load.show'
    ])->only(['index', 'show']);
    Route::patch('/logistics-load/{logisticsLoad}/update-status', [LogisticsLoadController::class, 'updateStatus'])->name('driver.logistics-load.update-status');
});

// Load Bids Routes (for Admin and Company users)
Route::middleware('auth')->group(function () {
    Route::resource('load-bids', LoadBidController::class);
});
