@extends('layouts.dashboard')

@section('title', 'Users by Type')
@section('page-title', 'Users by Type')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All user11</h5>
                        <a href="{{ route('register') }}" class="btn btn-success">Add New User</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.users.byType') }}" class="mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="{{ request('name') }}" class="form-control" placeholder="Search name">
                            </div>
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" name="email" value="{{ request('email') }}" class="form-control" placeholder="Search email">
                            </div>
                            <div class="col-md-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ request('phone') }}" class="form-control" placeholder="Search phone">
                            </div>
                            <div class="col-md-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" name="address" value="{{ request('address') }}" class="form-control" placeholder="Search address">
                            </div>
                            <div class="col-md-3">
                                <label for="created_from" class="form-label">Created from</label>
                                <input type="date" id="created_from" name="created_from" value="{{ request('created_from') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="created_to" class="form-label">Created to</label>
                                <input type="date" id="created_to" name="created_to" value="{{ request('created_to') }}" class="form-control">
                            </div>
                            <div class="col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.users.byType') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        @foreach($all as $user)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm border border-primary" style="border-radius: 18px;">
                                    <div class="card-body pb-2">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="rounded-circle bg-light border border-primary d-flex align-items-center justify-content-center me-3" style="width:48px;height:48px;font-size:1.5rem;font-weight:600;color:#3b82f6;">
                                                {{ strtoupper(substr($user->name,0,2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold" style="font-size:1.1rem;">{{ $user->name }}</div>
                                                {{-- <div class="text-muted small">{{ $user->type ?? 'User' }}</div> --}}
                                            </div>
                                        </div>
                                        <!-- Description removed -->
                                        <div class="mb-2">
                                            <div class="d-flex align-items-center mb-1 text-muted" style="font-size:0.97rem;">
                                                <i class="fas fa-map-marker-alt me-2"></i>
                                                @if(!empty($user->address))
                                                    {{ $user->address }}
                                                @elseif(!empty($user->location))
                                                    {{ $user->location }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center mb-1 text-muted" style="font-size:0.97rem;">
                                                <i class="fas fa-envelope me-2"></i>
                                                {{ $user->email ?? 'N/A' }}
                                            </div>
                                            <div class="d-flex align-items-center mb-1 text-muted" style="font-size:0.97rem;">
                                                <i class="fas fa-phone-alt me-2"></i>
                                                {{ $user->phone ?? 'N/A' }}
                                            </div>
                                            <div class="d-flex align-items-center text-muted" style="font-size:0.97rem;">
                                                <i class="fas fa-calendar-alt me-2"></i>
                                                {{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                         
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    {{ $all->withQueryString()->links() }}
                </div>
            </div>
        </div>
        {{-- <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Companies</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <td>{{ $company->created_at ? $company->created_at->format('Y-m-d') : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
