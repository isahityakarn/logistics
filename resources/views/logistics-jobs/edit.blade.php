@extends('layouts.dashboard')

@section('title', 'Edit Logistics Job')
@section('page-title', 'Edit Job #' . $logisticsJob->id)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-shadow border-0">
            <div class="card-header gradient-bg text-white">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Edit Job #{{ $logisticsJob->id }}
                </h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.logistics-jobs.update', $logisticsJob) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Pickup Information -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-box-arrow-up"></i>
                                Pickup Information
                            </h6>
                            
                            <div class="mb-3">
                                <label for="pickup_location" class="form-label">Pickup Location *</label>
                                <input type="text" class="form-control @error('pickup_location') is-invalid @enderror" 
                                       id="pickup_location" name="pickup_location" 
                                       value="{{ old('pickup_location', $logisticsJob->pickup_location) }}" required>
                                @error('pickup_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pickup_phone" class="form-label">Pickup Phone</label>
                                <input type="text" class="form-control @error('pickup_phone') is-invalid @enderror" 
                                       id="pickup_phone" name="pickup_phone" value="{{ old('pickup_phone', $logisticsJob->pickup_phone) }}">
                                @error('pickup_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pickup_company" class="form-label">Pickup Company</label>
                                <input type="text" class="form-control @error('pickup_company') is-invalid @enderror" 
                                       id="pickup_company" name="pickup_company" value="{{ old('pickup_company', $logisticsJob->pickup_company) }}">
                                @error('pickup_company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pickup_additional_info" class="form-label">Pickup Additional Info</label>
                                <textarea class="form-control @error('pickup_additional_info') is-invalid @enderror" 
                                          id="pickup_additional_info" name="pickup_additional_info" rows="3">{{ old('pickup_additional_info', $logisticsJob->pickup_additional_info) }}</textarea>
                                @error('pickup_additional_info')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pickup_latitude" class="form-label">Pickup Latitude</label>
                                        <input type="number" step="0.00000001" class="form-control @error('pickup_latitude') is-invalid @enderror" 
                                               id="pickup_latitude" name="pickup_latitude" value="{{ old('pickup_latitude', $logisticsJob->pickup_latitude) }}">
                                        @error('pickup_latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pickup_longitude" class="form-label">Pickup Longitude</label>
                                        <input type="number" step="0.00000001" class="form-control @error('pickup_longitude') is-invalid @enderror" 
                                               id="pickup_longitude" name="pickup_longitude" value="{{ old('pickup_longitude', $logisticsJob->pickup_longitude) }}">
                                        @error('pickup_longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pickup_date_time_from" class="form-label">Pickup Date/Time From</label>
                                        <input type="datetime-local" class="form-control @error('pickup_date_time_from') is-invalid @enderror" 
                                               id="pickup_date_time_from" name="pickup_date_time_from" 
                                               value="{{ old('pickup_date_time_from', $logisticsJob->pickup_date_time_from ? $logisticsJob->pickup_date_time_from->format('Y-m-d\TH:i') : '') }}">
                                        @error('pickup_date_time_from')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pickup_date_time_to" class="form-label">Pickup Date/Time To</label>
                                        <input type="datetime-local" class="form-control @error('pickup_date_time_to') is-invalid @enderror" 
                                               id="pickup_date_time_to" name="pickup_date_time_to" 
                                               value="{{ old('pickup_date_time_to', $logisticsJob->pickup_date_time_to ? $logisticsJob->pickup_date_time_to->format('Y-m-d\TH:i') : '') }}">
                                        @error('pickup_date_time_to')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="pickup_info" class="form-label">Pickup Info</label>
                                <input type="text" class="form-control @error('pickup_info') is-invalid @enderror" 
                                       id="pickup_info" name="pickup_info" value="{{ old('pickup_info', $logisticsJob->pickup_info) }}">
                                @error('pickup_info')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Delivery Information -->
                        <div class="col-md-6">
                            <h6 class="text-success mb-3">
                                <i class="bi bi-box-arrow-down"></i>
                                Delivery Information
                            </h6>
                            
                            <div class="mb-3">
                                <label for="delivery_location" class="form-label">Delivery Location *</label>
                                <input type="text" class="form-control @error('delivery_location') is-invalid @enderror" 
                                       id="delivery_location" name="delivery_location" 
                                       value="{{ old('delivery_location', $logisticsJob->delivery_location) }}" required>
                                @error('delivery_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="delivery_phone" class="form-label">Delivery Phone</label>
                                <input type="text" class="form-control @error('delivery_phone') is-invalid @enderror" 
                                       id="delivery_phone" name="delivery_phone" value="{{ old('delivery_phone', $logisticsJob->delivery_phone) }}">
                                @error('delivery_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="delivery_company" class="form-label">Delivery Company</label>
                                <input type="text" class="form-control @error('delivery_company') is-invalid @enderror" 
                                       id="delivery_company" name="delivery_company" value="{{ old('delivery_company', $logisticsJob->delivery_company) }}">
                                @error('delivery_company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="delivery_additional_info" class="form-label">Delivery Additional Info</label>
                                <textarea class="form-control @error('delivery_additional_info') is-invalid @enderror" 
                                          id="delivery_additional_info" name="delivery_additional_info" rows="3">{{ old('delivery_additional_info', $logisticsJob->delivery_additional_info) }}</textarea>
                                @error('delivery_additional_info')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="delivery_latitude" class="form-label">Delivery Latitude</label>
                                        <input type="number" step="0.00000001" class="form-control @error('delivery_latitude') is-invalid @enderror" 
                                               id="delivery_latitude" name="delivery_latitude" value="{{ old('delivery_latitude', $logisticsJob->delivery_latitude) }}">
                                        @error('delivery_latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="delivery_longitude" class="form-label">Delivery Longitude</label>
                                        <input type="number" step="0.00000001" class="form-control @error('delivery_longitude') is-invalid @enderror" 
                                               id="delivery_longitude" name="delivery_longitude" value="{{ old('delivery_longitude', $logisticsJob->delivery_longitude) }}">
                                        @error('delivery_longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="delivery_date_time_from" class="form-label">Delivery Date/Time From</label>
                                        <input type="datetime-local" class="form-control @error('delivery_date_time_from') is-invalid @enderror" 
                                               id="delivery_date_time_from" name="delivery_date_time_from" 
                                               value="{{ old('delivery_date_time_from', $logisticsJob->delivery_date_time_from ? $logisticsJob->delivery_date_time_from->format('Y-m-d\TH:i') : '') }}">
                                        @error('delivery_date_time_from')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="delivery_date_time_to" class="form-label">Delivery Date/Time To</label>
                                        <input type="datetime-local" class="form-control @error('delivery_date_time_to') is-invalid @enderror" 
                                               id="delivery_date_time_to" name="delivery_date_time_to" 
                                               value="{{ old('delivery_date_time_to', $logisticsJob->delivery_date_time_to ? $logisticsJob->delivery_date_time_to->format('Y-m-d\TH:i') : '') }}">
                                        @error('delivery_date_time_to')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="delivery_info" class="form-label">Delivery Info</label>
                                <input type="text" class="form-control @error('delivery_info') is-invalid @enderror" 
                                       id="delivery_info" name="delivery_info" value="{{ old('delivery_info', $logisticsJob->delivery_info) }}">
                                @error('delivery_info')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <!-- Job Details -->
                        <div class="col-md-6">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-briefcase"></i>
                                Job Details
                            </h6>
                            
                            <div class="mb-3">
                                <label for="job_description" class="form-label">Job Description</label>
                                <input type="text" class="form-control @error('job_description') is-invalid @enderror" 
                                       id="job_description" name="job_description" value="{{ old('job_description', $logisticsJob->job_description) }}">
                                @error('job_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="suggested_vehicle" class="form-label">Suggested Vehicle</label>
                                <input type="text" class="form-control @error('suggested_vehicle') is-invalid @enderror" 
                                       id="suggested_vehicle" name="suggested_vehicle" value="{{ old('suggested_vehicle', $logisticsJob->suggested_vehicle) }}">
                                @error('suggested_vehicle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="packaging" class="form-label">Packaging</label>
                                <input type="text" class="form-control @error('packaging') is-invalid @enderror" 
                                       id="packaging" name="packaging" value="{{ old('packaging', $logisticsJob->packaging) }}">
                                @error('packaging')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_of_items" class="form-label">Number of Items</label>
                                        <input type="number" class="form-control @error('no_of_items') is-invalid @enderror" 
                                               id="no_of_items" name="no_of_items" value="{{ old('no_of_items', $logisticsJob->no_of_items) }}" min="1">
                                        @error('no_of_items')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gross_weight" class="form-label">Gross Weight</label>
                                        <input type="number" step="0.01" class="form-control @error('gross_weight') is-invalid @enderror" 
                                               id="gross_weight" name="gross_weight" value="{{ old('gross_weight', $logisticsJob->gross_weight) }}">
                                        @error('gross_weight')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="weight_unit" class="form-label">Weight Unit</label>
                                        <select class="form-select @error('weight_unit') is-invalid @enderror" 
                                                id="weight_unit" name="weight_unit">
                                            <option value="kg" {{ old('weight_unit', $logisticsJob->weight_unit) == 'kg' ? 'selected' : '' }}>Kilograms</option>
                                            <option value="lbs" {{ old('weight_unit', $logisticsJob->weight_unit) == 'lbs' ? 'selected' : '' }}>Pounds</option>
                                            <option value="tons" {{ old('weight_unit', $logisticsJob->weight_unit) == 'tons' ? 'selected' : '' }}>Tons</option>
                                        </select>
                                        @error('weight_unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="body_type" class="form-label">Body Type</label>
                                        <input type="text" class="form-control @error('body_type') is-invalid @enderror" 
                                               id="body_type" name="body_type" value="{{ old('body_type', $logisticsJob->body_type) }}">
                                        @error('body_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="job_type" class="form-label">Job Type</label>
                                <select class="form-select @error('job_type') is-invalid @enderror" 
                                        id="job_type" name="job_type">
                                    <option value="pickup_delivery" {{ old('job_type', $logisticsJob->job_type) == 'pickup_delivery' ? 'selected' : '' }}>Pickup & Delivery</option>
                                    <option value="courier" {{ old('job_type', $logisticsJob->job_type) == 'courier' ? 'selected' : '' }}>Courier</option>
                                    <option value="freight" {{ old('job_type', $logisticsJob->job_type) == 'freight' ? 'selected' : '' }}>Freight</option>
                                    <option value="moving" {{ old('job_type', $logisticsJob->job_type) == 'moving' ? 'selected' : '' }}>Moving</option>
                                    <option value="other" {{ old('job_type', $logisticsJob->job_type) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('job_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Package Dimensions -->
                        <div class="col-md-6">
                            <h6 class="text-info mb-3">
                                <i class="bi bi-box"></i>
                                Package Dimensions
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="length" class="form-label">Length</label>
                                        <input type="number" step="0.01" class="form-control @error('length') is-invalid @enderror" 
                                               id="length" name="length" value="{{ old('length', $logisticsJob->length) }}">
                                        @error('length')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="width" class="form-label">Width</label>
                                        <input type="number" step="0.01" class="form-control @error('width') is-invalid @enderror" 
                                               id="width" name="width" value="{{ old('width', $logisticsJob->width) }}">
                                        @error('width')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="height" class="form-label">Height</label>
                                        <input type="number" step="0.01" class="form-control @error('height') is-invalid @enderror" 
                                               id="height" name="height" value="{{ old('height', $logisticsJob->height) }}">
                                        @error('height')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="dimension_unit" class="form-label">Dimension Unit</label>
                                        <select class="form-select @error('dimension_unit') is-invalid @enderror" 
                                                id="dimension_unit" name="dimension_unit">
                                            <option value="cm" {{ old('dimension_unit', $logisticsJob->dimension_unit) == 'cm' ? 'selected' : '' }}>Centimeters</option>
                                            <option value="inches" {{ old('dimension_unit', $logisticsJob->dimension_unit) == 'inches' ? 'selected' : '' }}>Inches</option>
                                            <option value="meters" {{ old('dimension_unit', $logisticsJob->dimension_unit) == 'meters' ? 'selected' : '' }}>Meters</option>
                                            <option value="feet" {{ old('dimension_unit', $logisticsJob->dimension_unit) == 'feet' ? 'selected' : '' }}>Feet</option>
                                        </select>
                                        @error('dimension_unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-secondary mb-3 mt-4">
                                <i class="bi bi-file-earmark-text"></i>
                                Additional Information
                            </h6>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                          id="notes" name="notes" rows="3">{{ old('notes', $logisticsJob->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="upload_document" class="form-label">Upload Document</label>
                                @if($logisticsJob->upload_document)
                                    <div class="mb-2">
                                        <small class="text-muted">Current: 
                                            <a href="{{ Storage::url($logisticsJob->upload_document) }}" target="_blank">
                                                {{ $logisticsJob->document_name ?? 'View Document' }}
                                            </a>
                                        </small>
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('upload_document') is-invalid @enderror" 
                                       id="upload_document" name="upload_document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <small class="text-muted">Leave empty to keep current document</small>
                                @error('upload_document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <!-- Distance and Pricing -->
                        <div class="col-md-6">
                            <h6 class="text-success mb-3">
                                <i class="bi bi-currency-dollar"></i>
                                Distance & Pricing
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="distance_km" class="form-label">Distance (KM)</label>
                                        <input type="number" step="0.01" class="form-control @error('distance_km') is-invalid @enderror" 
                                               id="distance_km" name="distance_km" value="{{ old('distance_km', $logisticsJob->distance_km) }}">
                                        @error('distance_km')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="distance_miles" class="form-label">Distance (Miles)</label>
                                        <input type="number" step="0.01" class="form-control @error('distance_miles') is-invalid @enderror" 
                                               id="distance_miles" name="distance_miles" value="{{ old('distance_miles', $logisticsJob->distance_miles) }}">
                                        @error('distance_miles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="rate_per_km" class="form-label">Rate per KM</label>
                                        <input type="number" step="0.01" class="form-control @error('rate_per_km') is-invalid @enderror" 
                                               id="rate_per_km" name="rate_per_km" value="{{ old('rate_per_km', $logisticsJob->rate_per_km) }}">
                                        @error('rate_per_km')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="rate_per_mile" class="form-label">Rate per Mile</label>
                                        <input type="number" step="0.01" class="form-control @error('rate_per_mile') is-invalid @enderror" 
                                               id="rate_per_mile" name="rate_per_mile" value="{{ old('rate_per_mile', $logisticsJob->rate_per_mile) }}">
                                        @error('rate_per_mile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <select class="form-select @error('currency') is-invalid @enderror" 
                                        id="currency" name="currency">
                                    <option value="INR" {{ old('currency', $logisticsJob->currency) == 'INR' ? 'selected' : '' }}>INR</option>
                                    <option value="USD" {{ old('currency', $logisticsJob->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="EUR" {{ old('currency', $logisticsJob->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                                    <option value="GBP" {{ old('currency', $logisticsJob->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                                    <option value="CAD" {{ old('currency', $logisticsJob->currency) == 'CAD' ? 'selected' : '' }}>CAD</option>
                                    <option value="AUD" {{ old('currency', $logisticsJob->currency) == 'AUD' ? 'selected' : '' }}>AUD</option>
                                </select>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Job Status -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-gear"></i>
                                Job Status
                            </h6>
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status">
                                    <option value="pending" {{ old('status', $logisticsJob->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="assigned" {{ old('status', $logisticsJob->status) == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                    <option value="in_progress" {{ old('status', $logisticsJob->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="picked_up" {{ old('status', $logisticsJob->status) == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                                    <option value="in_transit" {{ old('status', $logisticsJob->status) == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                    <option value="delivered" {{ old('status', $logisticsJob->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="completed" {{ old('status', $logisticsJob->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status', $logisticsJob->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($drivers->count() > 0)
                            <div class="mb-3">
                                <label for="driver_id" class="form-label">Assign Driver</label>
                                <select class="form-select @error('driver_id') is-invalid @enderror" 
                                        id="driver_id" name="driver_id">
                                    <option value="">Select Driver (Optional)</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" 
                                                {{ old('driver_id', $logisticsJob->driver_id) == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }}
                                            @if($driver->phone)
                                                ({{ $driver->phone }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.logistics-jobs.show', $logisticsJob) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i>
                                    Back to Job Details
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i>
                                    Update Logistics Job
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
