@extends('layouts.dashboard')

@section('title', 'Drivers Management')
@section('page-title', 'Drivers Management')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4>All Drivers</h4>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-shadow border-0">
            <div class="card-header gradient-bg text-white">
                <h5 class="mb-0">
                    <i class="bi bi-truck"></i>
                    Drivers List ({{ $drivers->total() }} total)
                </h5>
            </div>
            <div class="card-body">
                @if($drivers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Driver Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>License Number</th>
                                    <th>Total Jobs</th>
                                    <th>Active Jobs</th>
                                    <th>Completed Jobs</th>
                                    <th>Joined</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drivers as $driver)
                                <tr>
                                    <td>{{ $driver->id }}</td>
                                    <td>
                                        <strong>{{ $driver->name }}</strong>
                                        @if($driver->company_name)
                                            <br><small class="text-muted">{{ $driver->company_name }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $driver->email }}</td>
                                    <td>{{ $driver->phone ?? 'Not provided' }}</td>
                                    <td>
                                        @if($driver->license_number)
                                            <span class="badge bg-success">{{ $driver->license_number }}</span>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $driver->total_jobs ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">{{ $driver->active_jobs ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $driver->completed_jobs ?? 0 }}</span>
                                    </td>
                                    <td>{{ $driver->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($driver->active_jobs > 0)
                                            <span class="badge bg-warning">Active</span>
                                        @elseif($driver->total_jobs > 0)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-secondary">New</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $drivers->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-truck text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mt-3">No drivers found</h5>
                        <p class="text-muted">No drivers are currently registered in the system.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
