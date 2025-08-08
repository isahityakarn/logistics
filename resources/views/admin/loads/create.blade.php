@extends('layouts.dashboard')

@section('title', 'Loads Dashboard')
@section('page-title', 'Loads Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Create Load</h4>
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
                    <form action="{{ route('loads.store') }}" method="POST">
                        @csrf
                     
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-arrow-up"></i> Pickup Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Location <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="pickup_location" class="form-control"
                                                    value="{{ old('pickup_location') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="pickup_phone" class="form-control"
                                                    value="{{ old('pickup_phone') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Company</label>
                                                <input type="text" name="pickup_company" class="form-control"
                                                    value="{{ old('pickup_company') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Additional Info</label>
                                                <textarea name="pickup_additional_info" class="form-control">{{ old('pickup_additional_info') }}</textarea>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="number" step="any" name="pickup_latitude" class="form-control"
                                                    value="{{ old('pickup_latitude') }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="number" step="any" name="pickup_longitude" class="form-control"
                                                    value="{{ old('pickup_longitude') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time From</label>
                                                <input type="datetime-local" name="pickup_date_time_from"
                                                    class="form-control" value="{{ old('pickup_date_time_from') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time To</label>
                                                <input type="datetime-local" name="pickup_date_time_to" class="form-control"
                                                    value="{{ old('pickup_date_time_to') }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pickup Info</label>
                                            <textarea name="pickup_info" class="form-control">{{ old('pickup_info') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                            <div class="col-md-6">
                                <div class="card mb-4 border-success">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="fas fa-arrow-down"></i> Delivery Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Location <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="delivery_location" class="form-control"
                                                    value="{{ old('delivery_location') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="delivery_phone" class="form-control"
                                                    value="{{ old('delivery_phone') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Company</label>
                                                <input type="text" name="delivery_company" class="form-control"
                                                    value="{{ old('delivery_company') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Additional Info</label>
                                                <textarea name="delivery_additional_info" class="form-control">{{ old('delivery_additional_info') }}</textarea>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="number" step="any" name="delivery_latitude" class="form-control"
                                                    value="{{ old('delivery_latitude') }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="number" step="any" name="delivery_longitude" class="form-control"
                                                    value="{{ old('delivery_longitude') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time From</label>
                                                <input type="datetime-local" name="delivery_date_time_from"
                                                    class="form-control" value="{{ old('delivery_date_time_from') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time To</label>
                                                <input type="datetime-local" name="delivery_date_time_to"
                                                    class="form-control" value="{{ old('delivery_date_time_to') }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Delivery Info</label>
                                            <textarea name="delivery_info" class="form-control">{{ old('delivery_info') }}</textarea>
                                        </div>
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
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Job Description</label>
                                                <textarea name="job_description" class="form-control">{{ old('job_description') }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Suggested Vehicle</label>
                                                <input type="text" name="suggested_vehicle" class="form-control"
                                                    value="{{ old('suggested_vehicle') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Packaging</label>
                                                <input type="text" name="packaging" class="form-control"
                                                    value="{{ old('packaging') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">No of Items</label>
                                                <input type="number" name="no_of_items" class="form-control"
                                                    value="{{ old('no_of_items') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gross Weight</label>
                                                <input type="number" step="any" name="gross_weight" class="form-control"
                                                    value="{{ old('gross_weight') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Weight Unit</label>
                                                <input type="text" name="weight_unit" class="form-control"
                                                    value="{{ old('weight_unit') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Body Type</label>
                                                <input type="text" name="body_type" class="form-control"
                                                    value="{{ old('body_type') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job Type</label>
                                                <input type="text" name="job_type" class="form-control"
                                                    value="{{ old('job_type') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Length</label>
                                                <input type="number" step="any" name="length" class="form-control"
                                                    value="{{ old('length') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Width</label>
                                                <input type="number" step="any" name="width" class="form-control"
                                                    value="{{ old('width') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Height</label>
                                                <input type="number" step="any" name="height" class="form-control"
                                                    value="{{ old('height') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Dimension Unit</label>
                                                <input type="text" name="dimension_unit" class="form-control"
                                                    value="{{ old('dimension_unit') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Notes</label>
                                                <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     
                            <div class="col-md-6">
                                <div class="card mb-4 border-warning">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Documents & Pricing
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Document Name</label>
                                                <input type="text" name="document_name" class="form-control"
                                                    value="{{ old('document_name') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Upload Document</label>
                                                <input type="text" name="upload_document" class="form-control"
                                                    value="{{ old('upload_document') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Distance (km)</label>
                                                <input type="number" step="any" name="distance_km" class="form-control"
                                                    value="{{ old('distance_km') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Distance (miles)</label>
                                                <input type="number" step="any" name="distance_miles" class="form-control"
                                                    value="{{ old('distance_miles') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Rate per km</label>
                                                <input type="number" step="any" name="rate_per_km" class="form-control"
                                                    value="{{ old('rate_per_km') }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Rate per mile</label>
                                                <input type="number" step="any" name="rate_per_mile" class="form-control"
                                                    value="{{ old('rate_per_mile') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Currency</label>
                                                <input type="text" name="currency" class="form-control"
                                                    value="{{ old('currency') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Status</label>
                                                <input type="text" name="status" class="form-control"
                                                    value="{{ old('status', 'pending') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4 border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Assignment & Completion</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Assigned At</label>
                                                <input type="datetime-local" name="assigned_at" class="form-control" value="{{ old('assigned_at') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Completed At</label>
                                                <input type="datetime-local" name="completed_at" class="form-control" value="{{ old('completed_at') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-5 py-2 mt-3"><i class="fas fa-save"></i>
                                Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
