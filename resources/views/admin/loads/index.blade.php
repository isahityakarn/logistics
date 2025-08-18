                        @extends('layouts.dashboard')

                        @section('title', 'Loads Dashboard')
                        @section('page-title', 'Loads Dashboard')

                        @section('content')
                            <div class="container-fluid">
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('loads.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                        Add New Load</a>
                                </div>
                                <!-- Filter Form -->
                                <form method="GET" action="{{ route('loads.index') }}"
                                    class="mb-4 p-4 bg-light rounded shadow-sm">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label for="from" class="form-label">From</label>
                                            <input type="text" class="form-control" id="from" name="from"
                                                value="{{ request('from') }}" placeholder="Origin">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="to" class="form-label">To</label>
                                            <input type="text" class="form-control" id="to" name="to"
                                                value="{{ request('to') }}" placeholder="Destination">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="vehicle_type" class="form-label">Vehicle type</label>
                                            <select class="form-select" id="vehicle_type" name="vehicle_type">
                                                <option value="">Any</option>
                                                <option value="Truck"
                                                    {{ request('vehicle_type') == 'Truck' ? 'selected' : '' }}>Truck
                                                </option>
                                                <option value="Van"
                                                    {{ request('vehicle_type') == 'Van' ? 'selected' : '' }}>Van</option>
                                                <option value="Trailer"
                                                    {{ request('vehicle_type') == 'Trailer' ? 'selected' : '' }}>Trailer
                                                </option>
                                                <option value="Container"
                                                    {{ request('vehicle_type') == 'Container' ? 'selected' : '' }}>Container
                                                </option>
                                                <option value="Pickup"
                                                    {{ request('vehicle_type') == 'Pickup' ? 'selected' : '' }}>Pickup
                                                </option>
                                                <option value="Other"
                                                    {{ request('vehicle_type') == 'Other' ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="date_time" class="form-label">Date & Time</label>
                                            <input type="datetime-local" class="form-control" id="date_time"
                                                name="date_time" value="{{ request('date_time') }}">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="radius" class="form-label">Radius (<=km)</label>
                                                    <input type="number" class="form-control" id="radius" name="radius"
                                                        value="{{ request('radius') }}" min="0"
                                                        placeholder="Radius">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="packaging" class="form-label">Packaging</label>
                                            <select class="form-select" id="packaging" name="packaging">
                                                <option value="Box" {{ old('packaging') == 'Box' ? 'selected' : '' }}>
                                                    Box</option>
                                                <option value="Pallet"
                                                    {{ old('packaging') == 'Pallet' ? 'selected' : '' }}>Pallet
                                                </option>
                                                <option value="Crate" {{ old('packaging') == 'Crate' ? 'selected' : '' }}>
                                                    Crate</option>
                                                <option value="Bag" {{ old('packaging') == 'Bag' ? 'selected' : '' }}>
                                                    Bag</option>
                                                <option value="Drum" {{ old('packaging') == 'Drum' ? 'selected' : '' }}>
                                                    Drum</option>
                                                <option value="Other" {{ old('packaging') == 'Other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="">All</option>
                                                <option value="pending"
                                                    {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="assigned"
                                                    {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned
                                                </option>
                                                <option value="in_progress"
                                                    {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                                                </option>
                                                <option value="picked_up"
                                                    {{ request('status') == 'picked_up' ? 'selected' : '' }}>Picked Up
                                                </option>
                                                <option value="in_transit"
                                                    {{ request('status') == 'in_transit' ? 'selected' : '' }}>In Transit
                                                </option>
                                                <option value="delivered"
                                                    {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered
                                                </option>
                                                <option value="completed"
                                                    {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                                                </option>
                                                <option value="cancelled"
                                                    {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i>
                                            Filter</button>
                                        <a href="{{ route('loads.index') }}" class="btn btn-secondary">Reset</a>
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
                                                            <div class="col-4 ps-0 d-flex align-items-start"
                                                                style="text-align:left;">
                                                                <span style="min-width: 80px;"><strong>ID</strong></span>
                                                                <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="col-8 ps-2">{{ $load->id }}</div>
                                                        </div>
                                                        <div class="row g-0">
                                                            <div class="col-4 ps-0 d-flex align-items-start"
                                                                style="text-align:left;">
                                                                <span
                                                                    style="min-width: 80px;"><strong>Company</strong></span>
                                                                <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="col-8 ps-2">{{ $load->pickup_company }}</div>
                                                        </div>
                                                        <div class="row g-0">
                                                            <div class="col-4 ps-0 d-flex align-items-start"
                                                                style="text-align:left;">
                                                                <span
                                                                    style="min-width: 80px;"><strong>Pickup</strong></span>
                                                                <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="col-8 ps-2">{{ $load->pickup_location }}</div>
                                                        </div>
                                                        <div class="row g-0">
                                                            <div class="col-4 ps-0 d-flex align-items-start"
                                                                style="text-align:left;">
                                                                <span
                                                                    style="min-width: 80px;"><strong>Delivery</strong></span>
                                                                <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="col-8 ps-2">{{ $load->delivery_location }}</div>
                                                        </div>

                                                        <div class="row g-0">
                                                            <div class="col-4 ps-0 d-flex align-items-start"
                                                                style="text-align:left;">
                                                                <span
                                                                    style="min-width: 80px;"><strong>Distance</strong></span>
                                                                <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="col-8 ps-2">
                                                                {{ number_format($load->distance_km, 2) }} KM</div>
                                                        </div>
                                                        <div class="row g-0">
                                                            <div class="col-4 ps-0 d-flex align-items-start"
                                                                style="text-align:left;">
                                                                <span
                                                                    style="min-width: 80px;"><strong>Status</strong></span>
                                                                <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="col-8 ps-2">
                                                                {{ ucfirst(str_replace('_', ' ', $load->status)) }}</div>
                                                        </div>
                                                        <div class="row g-0">
                                                            <div class="col-4 ps-0 d-flex align-items-start"
                                                                style="text-align:left;">
                                                                <span
                                                                    style="min-width: 80px;"><strong>Created</strong></span>
                                                                <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="col-8 ps-2">
                                                                {{ $load->created_at ? $load->created_at->format('M d, Y') : '' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-white border-0 d-flex justify-content-between">
                                                    <a href="{{ route('loads.show', $load) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <div>
                                                        <a href="{{ route('bids.index', ['load_id' => $load->id]) }}"
                                                            class="btn btn-sm btn-info me-1">
                                                            <i class="fas fa-list"></i> Show Bids
                                                        </a>
                                                        <a href="{{ route('bids.create', ['load_id' => $load->id]) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-gavel"></i> Add Bid
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
