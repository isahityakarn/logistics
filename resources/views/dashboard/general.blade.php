@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Welcome Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-shadow border-0">
            <div class="card-header gradient-bg text-white">
                <h5 class="mb-0">
                    <i class="bi bi-person-circle"></i>
                    Welcome, {{ Auth::user()->name }}!
                </h5>
            </div>
                <div class="card-body">
                    <div class="text-center py-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        <h4 class="mt-3 mb-3">Account Created Successfully!</h4>
                        <p class="text-muted mb-4">
                            You have successfully registered as a <strong>{{ ucfirst(Auth::user()->user_type) }}</strong>. 
                            Your account is now active and ready to use.
                        </p>
                        
                        <div class="row text-start mt-4">
                            <div class="col-md-6">
                                <h6><i class="bi bi-person"></i> Profile Information</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                                    <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                                    <li><strong>User Type:</strong> {{ ucfirst(Auth::user()->user_type) }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-info-circle"></i> Additional Details</h6>
                                <ul class="list-unstyled">
                                    @if(Auth::user()->phone)
                                        <li><strong>Phone:</strong> {{ Auth::user()->phone }}</li>
                                    @endif
                                    @if(Auth::user()->company_name)
                                        <li><strong>Company:</strong> {{ Auth::user()->company_name }}</li>
                                    @endif
                                    @if(Auth::user()->license_number)
                                        <li><strong>License:</strong> {{ Auth::user()->license_number }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            @if(Auth::user()->user_type === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                    <i class="bi bi-speedometer2"></i>
                                    Go to Admin Dashboard
                                </a>
                            @elseif(Auth::user()->user_type === 'company')
                                <a href="{{ route('company.dashboard') }}" class="btn btn-success">
                                    <i class="bi bi-building"></i>
                                    Go to Company Dashboard
                                </a>
                            @elseif(Auth::user()->user_type === 'driver')
                                <a href="{{ route('driver.dashboard') }}" class="btn btn-warning">
                                    <i class="bi bi-truck"></i>
                                    Go to Driver Dashboard
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
