
@extends('layouts.dashboard')

@section('title', 'Loads Dashboard')
@section('page-title', 'Loads Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('loads.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Load</a>
    </div>
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
                                        <a href="{{ route('loads.show', $load) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('loads.edit', $load) }}" class="btn btn-warning btn-sm">Edit</a>
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
