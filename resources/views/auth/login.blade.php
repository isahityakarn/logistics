@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card card-shadow border-0">
                <div class="card-header gradient-bg text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login to Your Account
                    </h3>
                </div>
                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <!-- Hidden field for direct jobs access -->
                        <input type="hidden" name="redirect_to_jobs" id="redirect_to_jobs" value="false">
                        
                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i>
                                Email Address
                            </label>
                            <input type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus 
                                   placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock"></i>
                                Password
                            </label>
                            <input type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   placeholder="Enter your password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Login
                            </button>
                        </div>
                    </form>

                    <!-- Driver Quick Access Section -->
                    <div class="text-center mt-4 mb-4">
                        <div class="border-top pt-4">
                            <h6 class="text-muted mb-3">
                                <i class="bi bi-truck"></i>
                                For Drivers
                            </h6>
                            <p class="small text-muted mb-3">
                                Quick access for drivers to login and view logistics jobs
                            </p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="button" class="btn btn-outline-primary btn-sm" 
                                        onclick="document.getElementById('email').focus(); document.getElementById('email').placeholder='Enter driver email address';">
                                    <i class="bi bi-person"></i>
                                    Driver Login
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" 
                                        onclick="document.getElementById('redirect_to_jobs').value='true'; document.getElementById('email').focus(); document.getElementById('email').placeholder='Driver email for direct jobs access';">
                                    <i class="bi bi-truck"></i>
                                    Login & View Jobs
                                </button>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    "Login & View Jobs" takes you directly to available logistics jobs
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-0">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold">
                                Register here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
