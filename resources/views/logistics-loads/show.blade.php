@extends('layouts.dashboard')

@section('title', 'Logistics Job Details')
@section('page-title', 'Job #' . $logisticsJob->id . ' Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-shadow border-0">
            <div class="card-header gradient-bg text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-eye"></i>
                        Job #{{ $logisticsJob->id }} Details
                    </h5>
                    <div>
                        <span class="badge 
                            @if($logisticsJob->status === 'pending') bg-warning
                            @elseif($logisticsJob->status === 'assigned') bg-info
                            @elseif($logisticsJob->status === 'in_progress') bg-primary
                            @elseif($logisticsJob->status === 'picked_up') bg-secondary
                            @elseif($logisticsJob->status === 'in_transit') bg-dark
                            @elseif($logisticsJob->status === 'delivered') bg-success
                            @elseif($logisticsJob->status === 'completed') bg-success
                            @elseif($logisticsJob->status === 'cancelled') bg-danger
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $logisticsJob->status)) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <!-- Pickup Information -->
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-box-arrow-up"></i>
                            Pickup Information
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pickup Location:</label>
                            <p class="text-muted">{{ $logisticsJob->pickup_location ?? 'N/A' }}</p>
                        </div>

                        @if($logisticsJob->pickup_phone)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pickup Phone:</label>
                            <p class="text-muted">{{ $logisticsJob->pickup_phone }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->pickup_company)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pickup Company:</label>
                            <p class="text-muted">{{ $logisticsJob->pickup_company }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->pickup_additional_info)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Additional Info:</label>
                            <p class="text-muted">{{ $logisticsJob->pickup_additional_info }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->pickup_latitude && $logisticsJob->pickup_longitude)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Latitude:</label>
                                    <p class="text-muted">{{ $logisticsJob->pickup_latitude }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Longitude:</label>
                                    <p class="text-muted">{{ $logisticsJob->pickup_longitude }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($logisticsJob->pickup_date_time_from || $logisticsJob->pickup_date_time_to)
                        <div class="row">
                            @if($logisticsJob->pickup_date_time_from)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Pickup From:</label>
                                    <p class="text-muted">{{ $logisticsJob->pickup_date_time_from->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            @endif
                            @if($logisticsJob->pickup_date_time_to)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Pickup To:</label>
                                    <p class="text-muted">{{ $logisticsJob->pickup_date_time_to->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($logisticsJob->pickup_info)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pickup Info:</label>
                            <p class="text-muted">{{ $logisticsJob->pickup_info }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Delivery Information -->
                    <div class="col-md-6">
                        <h6 class="text-success mb-3">
                            <i class="bi bi-box-arrow-down"></i>
                            Delivery Information
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Delivery Location:</label>
                            <p class="text-muted">{{ $logisticsJob->delivery_location ?? 'N/A' }}</p>
                        </div>

                        @if($logisticsJob->delivery_phone)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Delivery Phone:</label>
                            <p class="text-muted">{{ $logisticsJob->delivery_phone }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->delivery_company)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Delivery Company:</label>
                            <p class="text-muted">{{ $logisticsJob->delivery_company }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->delivery_additional_info)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Additional Info:</label>
                            <p class="text-muted">{{ $logisticsJob->delivery_additional_info }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->delivery_latitude && $logisticsJob->delivery_longitude)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Latitude:</label>
                                    <p class="text-muted">{{ $logisticsJob->delivery_latitude }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Longitude:</label>
                                    <p class="text-muted">{{ $logisticsJob->delivery_longitude }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($logisticsJob->delivery_date_time_from || $logisticsJob->delivery_date_time_to)
                        <div class="row">
                            @if($logisticsJob->delivery_date_time_from)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Delivery From:</label>
                                    <p class="text-muted">{{ $logisticsJob->delivery_date_time_from->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            @endif
                            @if($logisticsJob->delivery_date_time_to)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Delivery To:</label>
                                    <p class="text-muted">{{ $logisticsJob->delivery_date_time_to->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($logisticsJob->delivery_info)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Delivery Info:</label>
                            <p class="text-muted">{{ $logisticsJob->delivery_info }}</p>
                        </div>
                        @endif
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
                        
                        @if($logisticsJob->job_description)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Job Description:</label>
                            <p class="text-muted">{{ $logisticsJob->job_description }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->suggested_vehicle)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Suggested Vehicle:</label>
                            <p class="text-muted">{{ $logisticsJob->suggested_vehicle }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->packaging)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Packaging:</label>
                            <p class="text-muted">{{ $logisticsJob->packaging }}</p>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Number of Items:</label>
                                    <p class="text-muted">{{ $logisticsJob->no_of_items }}</p>
                                </div>
                            </div>
                            @if($logisticsJob->gross_weight)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Gross Weight:</label>
                                    <p class="text-muted">{{ $logisticsJob->gross_weight }} {{ $logisticsJob->weight_unit }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($logisticsJob->body_type)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Body Type:</label>
                            <p class="text-muted">{{ $logisticsJob->body_type }}</p>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Job Type:</label>
                            <p class="text-muted">{{ ucfirst(str_replace('_', ' ', $logisticsJob->job_type)) }}</p>
                        </div>
                    </div>

                    <!-- Package Dimensions & Additional Info -->
                    <div class="col-md-6">
                        <h6 class="text-info mb-3">
                            <i class="bi bi-box"></i>
                            Package Dimensions
                        </h6>
                        
                        @if($logisticsJob->length || $logisticsJob->width || $logisticsJob->height)
                        <div class="row">
                            @if($logisticsJob->length)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Length:</label>
                                    <p class="text-muted">{{ $logisticsJob->length }} {{ $logisticsJob->dimension_unit }}</p>
                                </div>
                            </div>
                            @endif
                            @if($logisticsJob->width)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Width:</label>
                                    <p class="text-muted">{{ $logisticsJob->width }} {{ $logisticsJob->dimension_unit }}</p>
                                </div>
                            </div>
                            @endif
                            @if($logisticsJob->height)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Height:</label>
                                    <p class="text-muted">{{ $logisticsJob->height }} {{ $logisticsJob->dimension_unit }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($logisticsJob->notes)
                        <h6 class="text-secondary mb-3 mt-4">
                            <i class="bi bi-file-earmark-text"></i>
                            Notes
                        </h6>
                        <div class="mb-3">
                            <p class="text-muted">{{ $logisticsJob->notes }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->upload_document)
                        <h6 class="text-secondary mb-3 mt-4">
                            <i class="bi bi-paperclip"></i>
                            Attached Document
                        </h6>
                        <div class="mb-3">
                            <a href="{{ asset('storage/' . $logisticsJob->upload_document) }}" 
                               target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download"></i>
                                {{ $logisticsJob->document_name ?? 'Download Document' }}
                            </a>
                        </div>
                        @endif
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
                        
                        @if($logisticsJob->distance_km || $logisticsJob->distance_miles)
                        <div class="row">
                            @if($logisticsJob->distance_km)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Distance (KM):</label>
                                    <p class="text-muted">{{ $logisticsJob->distance_km }} km</p>
                                </div>
                            </div>
                            @endif
                            @if($logisticsJob->distance_miles)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Distance (Miles):</label>
                                    <p class="text-muted">{{ $logisticsJob->distance_miles }} miles</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($logisticsJob->rate_per_km || $logisticsJob->rate_per_mile)
                        <div class="row">
                            @if($logisticsJob->rate_per_km)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Rate per KM:</label>
                                    <p class="text-muted">{{ $logisticsJob->currency }} {{ $logisticsJob->rate_per_km }}</p>
                                </div>
                            </div>
                            @endif
                            @if($logisticsJob->rate_per_mile)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Rate per Mile:</label>
                                    <p class="text-muted">{{ $logisticsJob->currency }} {{ $logisticsJob->rate_per_mile }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Currency:</label>
                            <p class="text-muted">{{ $logisticsJob->currency }}</p>
                        </div>
                    </div>

                    <!-- Driver & Timestamps -->
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-person"></i>
                            Assignment & Timeline
                        </h6>
                        
                        @if($logisticsJob->driver)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Assigned Driver:</label>
                            <p class="text-muted">{{ $logisticsJob->driver->name }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->assigned_at)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Assigned At:</label>
                            <p class="text-muted">{{ $logisticsJob->assigned_at->format('M d, Y H:i') }}</p>
                        </div>
                        @endif

                        @if($logisticsJob->completed_at)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Completed At:</label>
                            <p class="text-muted">{{ $logisticsJob->completed_at->format('M d, Y H:i') }}</p>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Created At:</label>
                            <p class="text-muted">{{ $logisticsJob->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated:</label>
                            <p class="text-muted">{{ $logisticsJob->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('driver.logistics-loads.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Back to Loads
                            </a>
                            <div>
                                @can('update', $logisticsJob)
                                <a href="{{ route('driver.logistics-loads.edit', $logisticsJob) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit Load
                                </a>
                                @endcan
                                
                                @can('delete', $logisticsJob)
                                <form method="POST" action="{{ route('driver.logistics-loads.destroy', $logisticsJob) }}" 
                                      class="d-inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this load?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                        Delete Job
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
