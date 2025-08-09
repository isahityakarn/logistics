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
                        <i class="bi bi-building text-success" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-3">Companies</h5>
                        <h2 class="text-success">{{ $totalCompanies }}</h2>
                        <small class="text-muted">Click to view all</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.drivers') }}" class="text-decoration-none">
                <div class="card card-shadow border-0 h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-truck text-warning" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-3">Drivers</h5>
                        <h2 class="text-warning">{{ $totalDrivers }}</h2>
                        <small class="text-muted">Click to view all</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-shadow border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check text-info" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Admins</h5>
                    <h2 class="text-info">{{ $totalAdmins }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-shadow border-0 mb-4">
                        <div class="card-header gradient-bg text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-person-badge"></i>
                                Recent Drivers
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentDrivers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-shadow border-0 mb-4">
                        <div class="card-header gradient-bg text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-building"></i>
                                Recent Companies
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentCompanies as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
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

        <div class="col-lg-4 mb-4">
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
                            <i class="bi bi-person-plus"></i>
                            Add New User
                        </button>
                        <button class="btn btn-outline-success">
                            <i class="bi bi-building-add"></i>
                            Register Company
                        </button>
                        <button class="btn btn-outline-warning">
                            <i class="bi bi-truck"></i>
                            Add Driver
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
