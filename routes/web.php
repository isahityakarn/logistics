<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogisticsJobController;
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
    Route::resource('logistics-jobs', LogisticsJobController::class)->names([
        'index' => 'admin.logistics-jobs.index',
        'show' => 'admin.logistics-jobs.show',
        'edit' => 'admin.logistics-jobs.edit',
        'update' => 'admin.logistics-jobs.update',
        'destroy' => 'admin.logistics-jobs.destroy'
    ])->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('/logistics-jobs/{logisticsJob}/assign', [LogisticsJobController::class, 'assign'])->name('admin.logistics-jobs.assign');
    Route::patch('/logistics-jobs/{logisticsJob}/status', [LogisticsJobController::class, 'updateStatus'])->name('admin.logistics-jobs.update-status');
});

// Company Routes
Route::prefix('company')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'companyDashboard'])->name('company.dashboard');
    Route::resource('logistics-jobs', LogisticsJobController::class)->names([
        'index' => 'company.logistics-jobs.index',
        'show' => 'company.logistics-jobs.show',
        'edit' => 'company.logistics-jobs.edit',
        'update' => 'company.logistics-jobs.update',
        'destroy' => 'company.logistics-jobs.destroy'
    ])->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('/logistics-jobs/{logisticsJob}/assign', [LogisticsJobController::class, 'assign'])->name('company.logistics-jobs.assign');
    Route::patch('/logistics-jobs/{logisticsJob}/status', [LogisticsJobController::class, 'updateStatus'])->name('company.logistics-jobs.update-status');
});

// Driver Routes
Route::prefix('driver')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'driverDashboard'])->name('driver.dashboard');
    Route::resource('logistics-jobs', LogisticsJobController::class)->names([
        'index' => 'driver.logistics-jobs.index',
        'create' => 'driver.logistics-jobs.create',
        'store' => 'driver.logistics-jobs.store',
        'show' => 'driver.logistics-jobs.show',
        'edit' => 'driver.logistics-jobs.edit',
        'update' => 'driver.logistics-jobs.update'
    ])->only(['index', 'create', 'store', 'show', 'edit', 'update']);
    Route::post('/logistics-jobs/{logisticsJob}/accept', [LogisticsJobController::class, 'accept'])->name('driver.logistics-jobs.accept');
    Route::patch('/logistics-jobs/{logisticsJob}/status', [LogisticsJobController::class, 'updateStatus'])->name('driver.logistics-jobs.update-status');
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
        'show' => 'company.logistics-loads.show',
        'edit' => 'company.logistics-loads.edit',
        'update' => 'company.logistics-loads.update',
        'destroy' => 'company.logistics-loads.destroy'
    ])->only(['index', 'show', 'edit', 'update', 'destroy']);
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
