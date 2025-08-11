@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card card-shadow border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-people-fill text-primary" style="font-size: 2rem;"></i>
                <h5 class="card-title mt-3">Total Users</h5>
                <h2 class="text-primary">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.companies') }}" class="text-decoration-none">
                <div class="card card-shadow border-0 h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-truck text-warning" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-3">Load</h5>
                        <h2 class="text-success">{{ $totalLoads }}</h2>
                        {{-- <small class="text-muted">Click to view all</small> --}}
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.drivers') }}" class="text-decoration-none">
                <div class="card card-shadow border-0 h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-currency-rupee text-success" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-3">Bids</h5>
                        <h2 class="text-warning">{{ $totalBids }}</h2>
                        {{-- <small class="text-muted">Click to view all</small> --}}
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check text-info" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Loads Completed</h5>
                    <h2 class="text-info">{{ $totalLoadsCompleted }}</h2>
                </div>
            </div>
        </div>
    </div>

    
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-shadow border-0 mb-4">
                        <div class="card-header gradient-bg text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-person-badge"></i>
                                Recent Users
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            {{-- <th>Joined</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            {{-- <td>{{ $user->created_at->format('M d, Y') }}</td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-shadow border-0 mb-4">
                        <div class="card-header gradient-bg text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-building"></i>
                                Recent Load
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Pickup Location</th>
                                            <th>Dropoff Location</th>
                                            <th>KM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentLoad as $load)
                                        <tr>
                                            <td>{{ $load->pickup_location }}</td>
                                            <td>{{ $load->delivery_location }}</td>
                                            <td>{{ $load->distance_km }} KM</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-shadow border-0 mb-4">
                        <div class="card-header gradient-bg text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-building"></i>
                                Recent Bid
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentBid as $user)
                                        <tr>
                                            <td>{{ $user->loadRelation->pickup_company  }}</td>
                                            <td>{{ $user->price }}</td>
                                            <td>{{ $user->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
    </div>
@endsection
