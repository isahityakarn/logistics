@extends('layouts.dashboard')

@section('title', 'Logistics Jobs')
@section('page-title', 'Logistics Jobs Management')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4>All Logistics Jobs</h4>
            @if(Auth::user()->user_type === 'driver')
                <a href="{{ route('driver.logistics-loads.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i>
                    Create New Job
                </a>
            @endif
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card card-shadow border-0">
            <div class="card-header gradient-bg text-white">
                <h5 class="mb-0">
                    <i class="bi bi-list-ul"></i>
                    Jobs List
                </h5>
            </div>
            <div class="card-body">
                @if($jobs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pickup Location</th>
                                    <th>Delivery Contact</th>
                                    <th>Status</th>
                                    <th>Driver</th>
                                    <th>Total Price</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>
                                        <strong>{{ $job->pickup_location }}</strong><br>
                                        <small class="text-muted">{{ Str::limit($job->pickup_address, 30) }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $job->delivery_phone }}</strong><br>
                                        <small class="text-muted">{{ Str::limit($job->delivery_address, 30) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $job->getStatusBadgeClass() }}">
                                            {{ $job->getFormattedStatus() }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($job->driver)
                                            <i class="bi bi-person-check text-success"></i>
                                            {{ $job->driver->name }}
                                        @else
                                            <span class="text-muted">
                                                <i class="bi bi-person-dash"></i>
                                                Unassigned
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>${{ number_format($job->total_price, 2) }}</strong>
                                        <small class="text-muted d-block">{{ $job->currency }}</small>
                                    </td>
                                    <td>{{ $job->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(Auth::user()->user_type === 'admin')
                                                <a href="{{ route('admin.logistics-loads.show', $job) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            @elseif(Auth::user()->user_type === 'company')
                                                <a href="{{ route('company.logistics-loads.show', $job) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            @elseif(Auth::user()->user_type === 'driver')
                                                <a href="{{ route('driver.logistics-loads.show', $job) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            @endif
                                            
                                            @if(Auth::user()->user_type === 'driver')
                                                @if($job->status === 'pending' && !$job->driver_id)
                                                    <form action="{{ route('driver.logistics-loads.accept', $job) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to accept this job?')">
                                                            <i class="bi bi-check-circle"></i>
                                                        </button>
                                                    </form>
                                                @elseif($job->driver_id === Auth::id())
                                                    <a href="{{ route('driver.logistics-loads.edit', $job) }}" class="btn btn-sm btn-outline-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            <i class="bi bi-gear"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @if($job->status === 'assigned')
                                                                <li>
                                                                    <form action="{{ route('driver.logistics-loads.update-status', $job) }}" method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="status" value="in_progress">
                                                                        <button type="submit" class="dropdown-item">
                                                                            <i class="bi bi-play-circle"></i> Start Job
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @elseif($job->status === 'in_progress')
                                                                <li>
                                                                    <form action="{{ route('driver.logistics-loads.update-status', $job) }}" method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="status" value="picked_up">
                                                                        <button type="submit" class="dropdown-item">
                                                                            <i class="bi bi-box-arrow-up"></i> Mark Picked Up
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @elseif($job->status === 'picked_up')
                                                                <li>
                                                                    <form action="{{ route('driver.logistics-loads.update-status', $job) }}" method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="status" value="in_transit">
                                                                        <button type="submit" class="dropdown-item">
                                                                            <i class="bi bi-truck"></i> In Transit
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @elseif($job->status === 'in_transit')
                                                                <li>
                                                                    <form action="{{ route('driver.logistics-loads.update-status', $job) }}" method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="status" value="delivered">
                                                                        <button type="submit" class="dropdown-item">
                                                                            <i class="bi bi-check-circle"></i> Mark Delivered
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @elseif($job->status === 'delivered')
                                                                <li>
                                                                    <form action="{{ route('driver.logistics-loads.update-status', $job) }}" method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="status" value="completed">
                                                                        <button type="submit" class="dropdown-item">
                                                                            <i class="bi bi-check-circle-fill"></i> Complete Job
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endif
                                            
                                            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'company')
                                                @if(Auth::user()->user_type === 'admin')
                                                    <a href="{{ route('admin.logistics-loads.edit', $job) }}" class="btn btn-sm btn-outline-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.logistics-loads.destroy', $job) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @elseif(Auth::user()->user_type === 'company')
                                                    <a href="{{ route('company.logistics-loads.edit', $job) }}" class="btn btn-sm btn-outline-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('company.logistics-loads.destroy', $job) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $jobs->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mt-3">No logistics jobs found</h5>
                        <p class="text-muted">
                            @if(Auth::user()->user_type === 'driver')
                                Start by creating your first logistics job.
                            @else
                                No jobs are currently available for you.
                            @endif
                        </p>
                        @if(Auth::user()->user_type === 'driver')
                            <a href="{{ route('driver.logistics-loads.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                                Create First Job
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
