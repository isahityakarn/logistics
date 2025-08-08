@extends('layouts.dashboard')

@section('title', 'Company Dashboard')
@section('page-title', 'Company Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card card-shadow border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-truck text-primary" style="font-size: 2rem;"></i>
                <h5 class="card-title mt-3">Total Jobs</h5>
                <h2 class="text-primary">{{ $totalJobs }}</h2>
            </div>
        </div>
    </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam text-success" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Pending Jobs</h5>
                    <h2 class="text-success">{{ $pendingJobs }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle text-warning" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">In Transit</h5>
                    <h2 class="text-warning">{{ $inTransitJobs }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-currency-dollar text-info" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Completed</h5>
                    <h2 class="text-info">{{ $completedJobs }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card card-shadow border-0">
                <div class="card-header gradient-bg text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-list-ul"></i>
                        Recent Orders
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mt-3">No orders yet</h5>
                        <p class="text-muted">Your orders will appear here once you start receiving them.</p>
                        <button class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            Create First Order
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card card-shadow border-0 mb-3">
                <div class="card-header gradient-bg text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-badge"></i>
                        Company Profile
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Company Name:</strong><br>
                        <span class="text-muted">{{ Auth::user()->company_name ?? 'Not set' }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Contact Person:</strong><br>
                        <span class="text-muted">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong><br>
                        <span class="text-muted">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Phone:</strong><br>
                        <span class="text-muted">{{ Auth::user()->phone ?? 'Not set' }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Address:</strong><br>
                        <span class="text-muted">{{ Auth::user()->address ?? 'Not set' }}</span>
                    </div>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil"></i>
                        Edit Profile
                    </button>
                </div>
            </div>

            <div class="card card-shadow border-0">
                <div class="card-header gradient-bg text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-gear"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-plus-circle"></i>
                            Create Order
                        </button>
                        <button class="btn btn-outline-success">
                            <i class="bi bi-person-plus"></i>
                            Hire Driver
                        </button>
                        <button class="btn btn-outline-warning">
                            <i class="bi bi-truck"></i>
                            Track Shipments
                        </button>
                        <button class="btn btn-outline-info">
                            <i class="bi bi-graph-up"></i>
                            View Reports
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
