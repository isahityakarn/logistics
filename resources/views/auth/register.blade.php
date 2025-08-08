@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card card-shadow border-0">
                <div class="card-header gradient-bg text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="bi bi-person-plus"></i>
                        Create Your Account
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

                    <form method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person"></i>
                                    Full Name *
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autofocus 
                                       placeholder="Enter your full name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i>
                                    Email Address *
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       placeholder="Enter your email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock"></i>
                                    Password *
                                </label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required 
                                       placeholder="Enter password (min 6 characters)">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill"></i>
                                    Confirm Password *
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required 
                                       placeholder="Confirm your password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_type" class="form-label">
                                    <i class="bi bi-person-badge"></i>
                                    User Type *
                                </label>
                                <select class="form-select @error('user_type') is-invalid @enderror" 
                                        id="user_type" 
                                        name="user_type" 
                                        required 
                                        onchange="toggleUserTypeFields()">
                                    <option value="">Select User Type</option>
                                    <option value="company" {{ old('user_type') == 'company' ? 'selected' : '' }}>Company</option>
                                    <option value="driver" {{ old('user_type') == 'driver' ? 'selected' : '' }}>Driver</option>
                                </select>
                                @error('user_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-telephone"></i>
                                    Phone Number
                                </label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="Enter your phone number">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">
                                <i class="bi bi-geo-alt"></i>
                                Address
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      placeholder="Enter your address">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Company specific fields -->
                        <div id="companyFields" style="display: none;">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">
                                    <i class="bi bi-building"></i>
                                    Company Name *
                                </label>
                                <input type="text" 
                                       class="form-control @error('company_name') is-invalid @enderror" 
                                       id="company_name" 
                                       name="company_name" 
                                       value="{{ old('company_name') }}" 
                                       placeholder="Enter your company name">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Driver specific fields -->
                        <div id="driverFields" style="display: none;">
                            <div class="mb-3">
                                <label for="license_number" class="form-label">
                                    <i class="bi bi-card-text"></i>
                                    License Number *
                                </label>
                                <input type="text" 
                                       class="form-control @error('license_number') is-invalid @enderror" 
                                       id="license_number" 
                                       name="license_number" 
                                       value="{{ old('license_number') }}" 
                                       placeholder="Enter your driving license number">
                                @error('license_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus"></i>
                                Create Account
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0">Already have an account? 
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold">
                                Login here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleUserTypeFields() {
    const userType = document.getElementById('user_type').value;
    const companyFields = document.getElementById('companyFields');
    const driverFields = document.getElementById('driverFields');
    
    // Hide all specific fields first
    companyFields.style.display = 'none';
    driverFields.style.display = 'none';
    
    // Remove required attribute from all conditional fields
    document.getElementById('company_name').removeAttribute('required');
    document.getElementById('license_number').removeAttribute('required');
    
    // Show specific fields based on user type
    if (userType === 'company') {
        companyFields.style.display = 'block';
        document.getElementById('company_name').setAttribute('required', 'required');
    } else if (userType === 'driver') {
        driverFields.style.display = 'block';
        document.getElementById('license_number').setAttribute('required', 'required');
    }
}

// Show fields on page load if there's an old value
document.addEventListener('DOMContentLoaded', function() {
    toggleUserTypeFields();
});
</script>
@endsection
