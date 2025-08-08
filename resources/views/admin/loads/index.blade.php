
@extends('layouts.dashboard')

@section('title', 'Loads Dashboard')
@section('page-title', 'Loads Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('loads.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Load</a>
    </div>
    <form method="GET" action="" class="mb-3">
        <div class="row align-items-end">
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="picked_up" {{ request('status') == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                    <option value="in_transit" {{ request('status') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </div>
    </form>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="mb-2" style="font-size:2rem;"><i class="fas fa-box"></i></div>
                    <div>Total Loads</div>
                    <div class="h3">{{ $loads->count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="mb-2" style="font-size:2rem;"><i class="fas fa-building"></i></div>
                    <div>Companies</div>
                    <div class="h3">{{ $companiesCount ?? '-' }}</div>
                    <small>Click to view all</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="mb-2" style="font-size:2rem;"><i class="fas fa-truck"></i></div>
                    <div>Drivers</div>
                    <div class="h3">{{ $driversCount ?? '-' }}</div>
                    <small>Click to view all</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="mb-2" style="font-size:2rem;"><i class="fas fa-check-circle"></i></div>
                    <div>Completed Loads</div>
                    <div class="h3">{{ $completedLoadsCount ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-list"></i> Recent Loads
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Pickup</th>
                                <th>Delivery</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loads->take(5) as $load)
                                <tr>
                                    <td>{{ $load->id }}</td>
                                    <td>{{ $load->company_id }}</td>
                                    <td>{{ $load->pickup_location }}</td>
                                    <td>{{ $load->delivery_location }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ ucfirst($load->status) }}</span>
                                    </td>
                                    <td>{{ $load->created_at ? $load->created_at->format('M d, Y') : '' }}</td>
                                    <td>
                                    <a href="{{ route('loads.show', $load) }}" class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('loads.edit', $load) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                        <!-- If the icon does not show, ensure FontAwesome 5+ is loaded in your layout. -->
                                    </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center">No loads found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  
    </div>
</div>
@endsection
