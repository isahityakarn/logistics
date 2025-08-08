<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogisticsLoadController;
use App\Http\Controllers\LoadBidController;

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
});

// Company Routes
Route::prefix('company')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'companyDashboard'])->name('company.dashboard');
});

// Driver Routes
Route::prefix('driver')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'driverDashboard'])->name('driver.dashboard');
});

// Logistics Loads Routes
// Admin Routes for Logistics Loads
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('logistics-loads', LogisticsLoadController::class)->names([
        'index' => 'admin.logistics-loads.index',
        'show' => 'admin.logistics-loads.show',
        'edit' => 'admin.logistics-loads.edit',
        'update' => 'admin.logistics-loads.update',
        'destroy' => 'admin.logistics-loads.destroy'
    ])->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('/logistics-loads/{logisticsLoad}/assign', [LogisticsLoadController::class, 'assign'])->name('admin.logistics-loads.assign');
    Route::patch('/logistics-loads/{logisticsLoad}/status', [LogisticsLoadController::class, 'updateStatus'])->name('admin.logistics-loads.update-status');
});

// Company Routes for Logistics Loads
Route::prefix('company')->middleware('auth')->group(function () {
    Route::resource('logistics-loads', LogisticsLoadController::class)->names([
        'index' => 'company.logistics-loads.index',
        'create' => 'company.logistics-loads.create',
        'store' => 'company.logistics-loads.store',
        'show' => 'company.logistics-loads.show',
        'edit' => 'company.logistics-loads.edit',
        'update' => 'company.logistics-loads.update',
        'destroy' => 'company.logistics-loads.destroy'
    ])->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::post('/logistics-loads/{logisticsLoad}/assign', [LogisticsLoadController::class, 'assign'])->name('company.logistics-loads.assign');
    Route::patch('/logistics-loads/{logisticsLoad}/status', [LogisticsLoadController::class, 'updateStatus'])->name('company.logistics-loads.update-status');
});

// Driver Routes for Logistics Loads
Route::prefix('driver')->middleware('auth')->group(function () {
    Route::resource('logistics-loads', LogisticsLoadController::class)->names([
        'index' => 'driver.logistics-loads.index',
        'create' => 'driver.logistics-loads.create',
        'store' => 'driver.logistics-loads.store',
        'show' => 'driver.logistics-loads.show',
        'edit' => 'driver.logistics-loads.edit',
        'update' => 'driver.logistics-loads.update'
    ])->only(['index', 'create', 'store', 'show', 'edit', 'update']);
    Route::post('/logistics-loads/{logisticsLoad}/accept', [LogisticsLoadController::class, 'accept'])->name('driver.logistics-loads.accept');
    Route::patch('/logistics-loads/{logisticsLoad}/status', [LogisticsLoadController::class, 'updateStatus'])->name('driver.logistics-loads.update-status');
});

// Load Bids Routes (for Admin and Company users)
Route::middleware('auth')->group(function () {
    Route::resource('load-bids', LoadBidController::class);
});
