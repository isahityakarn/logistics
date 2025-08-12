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
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="picked_up" {{ request('status') == 'picked_up' ? 'selected' : '' }}>Picked Up
                        </option>
                        <option value="in_transit" {{ request('status') == 'in_transit' ? 'selected' : '' }}>In Transit
                        </option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered
                        </option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                        </option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
        {{-- <div class="row mb-4">
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
                       
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <div class="mb-2" style="font-size:2rem;"><i class="fas fa-truck"></i></div>
                        <div>Drivers</div>
                        <div class="h3">{{ $driversCount ?? '-' }}</div>
                       
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
        </div> --}}

        <div class="row">
            @forelse($loads as $load)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="mb-2">
                                <div class="row g-0">
                                    <div class="col-4 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 80px;"><strong>ID</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-8 ps-2">{{ $load->id }}</div>
                                </div>
                        
                                <div class="row g-0">
                                    <div class="col-4 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 80px;"><strong>Company</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-8 ps-2">{{ $load->pickup_company }}</div>
                                </div>
                                        <div class="row g-0">
                                    <div class="col-4 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 80px;"><strong>Pickup</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-8 ps-2">{{ $load->pickup_location }}</div>
                                </div>
                                <div class="row g-0">
                                    <div class="col-4 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 80px;"><strong>Delivery</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-8 ps-2">{{ $load->delivery_location }}</div>
                                </div>
                                <div class="row g-0">
                                    <div class="col-4 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 80px;"><strong>Distance</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-8 ps-2">{{ number_format($load->distance_km, 2) }} KM</div>
                                </div>
                                <div class="row g-0">
                                    <div class="col-4 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 80px;"><strong>Status</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-8 ps-2">
                                        <form method="POST" action="{{ route('loads.changeStatus', $load) }}" class="d-flex align-items-center">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm me-2" style="width:auto;display:inline-block;">
                                                <option value="pending" {{ $load->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="assigned" {{ $load->status == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                                <option value="in_progress" {{ $load->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="picked_up" {{ $load->status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                                                <option value="in_transit" {{ $load->status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                                <option value="delivered" {{ $load->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="completed" {{ $load->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $load->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-outline-success">Update</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row g-0">
                                    <div class="col-4 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 80px;"><strong>Created</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-8 ps-2">{{ $load->created_at ? $load->created_at->format('M d, Y') : '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="{{ route('loads.show', $load) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <div>
                                <a href="{{ route('loads.edit', $load) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('bids.index', ['load_id' => $load->id]) }}" class="btn btn-sm btn-info me-1">
                                    <i class="fas fa-list"></i> Show Bids
                                </a>
                                <a href="{{ route('bids.create', ['load_id' => $load->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-gavel"></i> Assign Bid
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">No loads found.</div>
                </div>
            @endforelse
        </div>
        <div class="p-3">
            {{ $loads->links() }}
        </div>
    </div>
@endsection
