@extends('layouts.dashboard')

@section('title', 'Logistics Jobs Prices')
@section('page-title', 'Logistics Jobs Price Management')


@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Logistics Job Price</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('load-bids.update', $logisticsJobPrice) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="logisticjob_id" class="form-label">Logistics Job <span class="text-danger">*</span></label>
                                    <select name="logisticjob_id" id="logisticjob_id" class="form-select @error('logisticjob_id') is-invalid @enderror" required>
                                        <option value="">Select Job</option>
                                        @foreach($logisticsJobs as $job)
                                            <option value="{{ $job->id }}" {{ (old('logisticjob_id') ?? $logisticsJobPrice->logisticjob_id) == $job->id ? 'selected' : '' }}>
                                                #{{ $job->id }} - {{ Str::limit($job->job_description ?? 'No description', 50) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('logisticjob_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if(auth()->user()->user_type === 'admin')
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                                        <select name="company_id" id="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
                                            <option value="">Select Company</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{ (old('company_id') ?? $logisticsJobPrice->company_id) == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }} ({{ $company->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="company_id" value="{{ auth()->id() }}">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               name="price" 
                                               id="price" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               value="{{ old('price') ?? $logisticsJobPrice->price }}" 
                                               step="0.01" 
                                               min="0" 
                                               placeholder="0.00" 
                                               required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                             @if (auth()->user()->user_type === 'driver')
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="pending" {{ (old('status') ?? $logisticsJobPrice->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="assigned" {{ (old('status') ?? $logisticsJobPrice->status) == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                        <option value="in_progress" {{ (old('status') ?? $logisticsJobPrice->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="picked_up" {{ (old('status') ?? $logisticsJobPrice->status) == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                                        <option value="in_transit" {{ (old('status') ?? $logisticsJobPrice->status) == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                        <option value="delivered" {{ (old('status') ?? $logisticsJobPrice->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="completed" {{ (old('status') ?? $logisticsJobPrice->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ (old('status') ?? $logisticsJobPrice->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                              @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('load-bids.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Price
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
