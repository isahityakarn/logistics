@extends('layouts.dashboard')

@section('title', 'Companies Management')
@section('page-title', 'Companies Management')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4>All Companies</h4>
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
                    <i class="bi bi-building"></i>
                    Companies List ({{ $companies->total() }} total)
                </h5>
            </div>
            <div class="card-body">
                @if($companies->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Details</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Joined</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>
                                        <strong>{{ $company->company_name ?? 'Not provided' }}</strong>
                                        @if($company->company_name)
                                            <br><small class="text-muted">Business Account</small>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $company->name }}</strong>
                                        <br><small class="text-muted">Contact Person</small>
                                    </td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->phone ?? 'Not provided' }}</td>
                                    <td>
                                        @if($company->address)
                                            {{ Str::limit($company->address, 30) }}
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </td>
                                    <td>{{ $company->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($company->email_verified_at)
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $companies->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-building text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mt-3">No companies found</h5>
                        <p class="text-muted">No companies are currently registered in the system.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
