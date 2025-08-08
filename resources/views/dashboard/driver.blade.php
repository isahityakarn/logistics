@extends('layouts.dashboard')

@section('title', 'Driver Dashboard')
@section('page-title', 'Driver Dashboard')
    
@section('content')
    <div class="row mb-4">
    


        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-list-check text-primary" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Available Loads</h5>
                    <h2 class="text-primary">{{ $availableJobsCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-check text-info" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">My Assigned Loads</h5>
                    <h2 class="text-info">{{ $assignedJobsCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Completed Loads</h5>
                    <h2 class="text-success">{{ $completedJobsCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-currency-dollar text-warning" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Total Earnings</h5>
                    <h2 class="text-warning">${{ $totalEarnings ?? '' }}</h2>
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
                        Available Loads
                    </h5>
                </div>
                <div class="card-body">
                    @if ($availableJobs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Job #</th>
                                        <th>Pickup</th>
                                        <th>Delivery</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($availableJobs as $job)
                                        <tr>
                                            <td><strong>#{{ $job->id }}</strong></td>
                                            <td>
                                                <strong>{{ $job->pickup_location }}</strong><br>
                                                <small
                                                    class="text-muted">{{ Str::limit($job->pickup_address, 25) }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $job->delivery_contact }}</strong><br>
                                                <small
                                                    class="text-muted">{{ Str::limit($job->delivery_address, 25) }}</small>
                                            </td>
                                            <td>
                                                <strong
                                                    class="text-success">${{ number_format($job->total_price, 2) }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">Available</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('driver.logistics-load.show', $job) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('driver.logistics-load.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-list-ul"></i>
                                View All Available Loads
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                            <h5 class="text-muted mt-3">No loads available</h5>
                            <p class="text-muted">Check back later for new delivery opportunities.</p>
                            <a href="{{ route('driver.logistics-load.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-clockwise"></i>
                                Refresh Loads
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card card-shadow border-0 mb-3">
                <div class="card-header gradient-bg text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-badge"></i>
                        Driver Profile
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Full Name:</strong><br>
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
                        <strong>License Number:</strong><br>
                        <span class="text-muted">{{ Auth::user()->license_number ?? 'Not set' }}</span>
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
                        <a href="{{ route('driver.logistics-load.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-search"></i>
                            Available Loads
                        </a>
                        <a href="{{ route('driver.logistics-load.index') }}?status=assigned&driver={{ Auth::id() }}"
                            class="btn btn-outline-success">
                            <i class="bi bi-list-check"></i>
                            My Assigned Loads
                        </a>
                        <a href="{{ route('driver.logistics-load.index') }}?status=completed&driver={{ Auth::id() }}"
                            class="btn btn-outline-warning">
                            <i class="bi bi-clock-history"></i>
                            Load History
                        </a>
                        <button class="btn btn-outline-info">
                            <i class="bi bi-chat-dots"></i>
                            Support
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
