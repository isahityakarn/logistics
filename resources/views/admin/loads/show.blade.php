
@extends('layouts.dashboard')

@section('title', 'Loads Dashboard')
@section('page-title', 'Loads Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Load Details</h2>
        <div>
            <a href="{{ route('loads.index') }}" class="btn btn-secondary me-2">Back to List</a>
            <a href="{{ route('loads.edit', $load) }}" class="btn btn-warning me-2">Edit</a>
            <form action="{{ route('loads.destroy', $load) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-arrow-up"></i> Pickup Details</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Location</dt>
                        <dd class="col-sm-7">{{ $load->pickup_location }}</dd>
                        <dt class="col-sm-5">Phone</dt>
                        <dd class="col-sm-7">{{ $load->pickup_phone }}</dd>
                        <dt class="col-sm-5">Company</dt>
                        <dd class="col-sm-7">{{ $load->pickup_company }}</dd>
                        <dt class="col-sm-5">Additional Info</dt>
                        <dd class="col-sm-7">{{ $load->pickup_additional_info }}</dd>
                        {{-- <dt class="col-sm-5">Latitude</dt>
                        <dd class="col-sm-7">{{ $load->pickup_latitude }}</dd>
                        <dt class="col-sm-5">Longitude</dt>
                        <dd class="col-sm-7">{{ $load->pickup_longitude }}</dd> --}}
                        <dt class="col-sm-5">Date Time From</dt>
                        <dd class="col-sm-7">{{ $load->pickup_date_time_from }}</dd>
                        <dt class="col-sm-5">Date Time To</dt>
                        <dd class="col-sm-7">{{ $load->pickup_date_time_to }}</dd>
                        <dt class="col-sm-5">Pickup Info</dt>
                        <dd class="col-sm-7">{{ $load->pickup_info }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-arrow-down"></i> Delivery Details</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Location</dt>
                        <dd class="col-sm-7">{{ $load->delivery_location }}</dd>
                        <dt class="col-sm-5">Phone</dt>
                        <dd class="col-sm-7">{{ $load->delivery_phone }}</dd>
                        <dt class="col-sm-5">Company</dt>
                        <dd class="col-sm-7">{{ $load->delivery_company }}</dd>
                        <dt class="col-sm-5">Additional Info</dt>
                        <dd class="col-sm-7">{{ $load->delivery_additional_info }}</dd>
                        {{-- <dt class="col-sm-5">Latitude</dt>
                        <dd class="col-sm-7">{{ $load->delivery_latitude }}</dd>
                        <dt class="col-sm-5">Longitude</dt>
                        <dd class="col-sm-7">{{ $load->delivery_longitude }}</dd> --}}
                        <dt class="col-sm-5">Date Time From</dt>
                        <dd class="col-sm-7">{{ $load->delivery_date_time_from }}</dd>
                        <dt class="col-sm-5">Date Time To</dt>
                        <dd class="col-sm-7">{{ $load->delivery_date_time_to }}</dd>
                        <dt class="col-sm-5">Delivery Info</dt>
                        <dd class="col-sm-7">{{ $load->delivery_info }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-box"></i> Job & Cargo Details</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Job Description</dt>
                        <dd class="col-sm-7">{{ $load->job_description }}</dd>
                        <dt class="col-sm-5">Suggested Vehicle</dt>
                        <dd class="col-sm-7">{{ $load->suggested_vehicle }}</dd>
                        <dt class="col-sm-5">Packaging</dt>
                        <dd class="col-sm-7">{{ $load->packaging }}</dd>
                        <dt class="col-sm-5">No of Items</dt>
                        <dd class="col-sm-7">{{ $load->no_of_items }}</dd>
                        <dt class="col-sm-5">Gross Weight</dt>
                        <dd class="col-sm-7">{{ $load->gross_weight }}</dd>
                        <dt class="col-sm-5">Weight Unit</dt>
                        <dd class="col-sm-7">{{ $load->weight_unit }}</dd>
                        <dt class="col-sm-5">Body Type</dt>
                        <dd class="col-sm-7">{{ $load->body_type }}</dd>
                        <dt class="col-sm-5">Job Type</dt>
                        <dd class="col-sm-7">{{ $load->job_type }}</dd>
                        <dt class="col-sm-5">Length</dt>
                        <dd class="col-sm-7">{{ $load->length }}</dd>
                        <dt class="col-sm-5">Width</dt>
                        <dd class="col-sm-7">{{ $load->width }}</dd>
                        <dt class="col-sm-5">Height</dt>
                        <dd class="col-sm-7">{{ $load->height }}</dd>
                        <dt class="col-sm-5">Dimension Unit</dt>
                        <dd class="col-sm-7">{{ $load->dimension_unit }}</dd>
                        <dt class="col-sm-5">Notes</dt>
                        <dd class="col-sm-7">{{ $load->notes }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Documents & Pricing</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Document Name</dt>
                        <dd class="col-sm-7">{{ $load->document_name }}</dd>
                        <dt class="col-sm-5">Upload Document</dt>
                        <dd class="col-sm-7">{{ $load->upload_document }}</dd>
                        <dt class="col-sm-5">Distance (km)</dt>
                        <dd class="col-sm-7">{{ $load->distance_km }}</dd>

                        {{-- <dt class="col-sm-5">Distance (miles)</dt>
                        <dd class="col-sm-7">{{ $load->distance_miles }}</dd>
                        <dt class="col-sm-5">Rate per km</dt>
                        <dd class="col-sm-7">{{ $load->rate_per_km }}</dd>
                        <dt class="col-sm-5">Rate per mile</dt>
                        <dd class="col-sm-7">{{ $load->rate_per_mile }}</dd>
                        <dt class="col-sm-5">Currency</dt>
                        <dd class="col-sm-7">{{ $load->currency }}</dd> --}}

                        <dt class="col-sm-5">Status</dt>
                        <dd class="col-sm-7">{{ $load->status }}</dd>
                    </dl>
                </div>
            </div>
            <div class="card mb-4 border-secondary">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Assignment & Completion</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Assigned At</dt>
                        <dd class="col-sm-7">{{ $load->assigned_at }}</dd>
                        <dt class="col-sm-5">Completed At</dt>
                        <dd class="col-sm-7">{{ $load->completed_at }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
