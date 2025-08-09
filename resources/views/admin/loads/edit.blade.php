
@extends('layouts.dashboard')

@section('title', 'Loads Dashboard')
@section('page-title', 'Loads Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Load</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('loads.index') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('loads.update', $load) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-arrow-up"></i> Pickup Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Location <span class="text-danger">*</span></label>
                                                <input type="text" name="pickup_location" class="form-control" value="{{ old('pickup_location', $load->pickup_location) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="pickup_phone" class="form-control" value="{{ old('pickup_phone', $load->pickup_phone) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Company</label>
                                                <input type="text" name="pickup_company" class="form-control" value="{{ old('pickup_company', $load->pickup_company) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Additional Info</label>
                                                <textarea name="pickup_additional_info" class="form-control">{{ old('pickup_additional_info', $load->pickup_additional_info) }}</textarea>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="number" step="any" name="pickup_latitude" class="form-control" value="{{ old('pickup_latitude', $load->pickup_latitude) }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="number" step="any" name="pickup_longitude" class="form-control" value="{{ old('pickup_longitude', $load->pickup_longitude) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time From</label>
                                                <input type="datetime-local" name="pickup_date_time_from" class="form-control" value="{{ old('pickup_date_time_from', $load->pickup_date_time_from) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time To</label>
                                                <input type="datetime-local" name="pickup_date_time_to" class="form-control" value="{{ old('pickup_date_time_to', $load->pickup_date_time_to) }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pickup Info</label>
                                            <textarea name="pickup_info" class="form-control">{{ old('pickup_info', $load->pickup_info) }}</textarea>
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
                                                <label class="form-label">Location <span class="text-danger">*</span></label>
                                                <input type="text" name="delivery_location" class="form-control" value="{{ old('delivery_location', $load->delivery_location) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="delivery_phone" class="form-control" value="{{ old('delivery_phone', $load->delivery_phone) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Company</label>
                                                <input type="text" name="delivery_company" class="form-control" value="{{ old('delivery_company', $load->delivery_company) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Additional Info</label>
                                                <textarea name="delivery_additional_info" class="form-control">{{ old('delivery_additional_info', $load->delivery_additional_info) }}</textarea>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="number" step="any" name="delivery_latitude" class="form-control" value="{{ old('delivery_latitude', $load->delivery_latitude) }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="number" step="any" name="delivery_longitude" class="form-control" value="{{ old('delivery_longitude', $load->delivery_longitude) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time From</label>
                                                <input type="datetime-local" name="delivery_date_time_from" class="form-control" value="{{ old('delivery_date_time_from', $load->delivery_date_time_from) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date Time To</label>
                                                <input type="datetime-local" name="delivery_date_time_to" class="form-control" value="{{ old('delivery_date_time_to', $load->delivery_date_time_to) }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Delivery Info</label>
                                            <textarea name="delivery_info" class="form-control">{{ old('delivery_info', $load->delivery_info) }}</textarea>
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
                                                <select name="job_description" id="job_description_select" class="form-control" onchange="toggleOtherJobDescription()">
                                                    <option value="Delivery Directi" {{ old('job_description', $load->job_description) == 'Delivery Directi' ? 'selected' : '' }}>Delivery Directi</option>
                                                    <option value="Pickup Only" {{ old('job_description', $load->job_description) == 'Pickup Only' ? 'selected' : '' }}>Pickup Only</option>
                                                    <option value="Warehouse Transfer" {{ old('job_description', $load->job_description) == 'Warehouse Transfer' ? 'selected' : '' }}>Warehouse Transfer</option>
                                                    <option value="Line Haul" {{ old('job_description', $load->job_description) == 'Line Haul' ? 'selected' : '' }}>Line Haul</option>
                                                    <option value="Other" {{ old('job_description', $load->job_description) == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <input type="text" name="job_description_other" id="job_description_other" class="form-control mt-2" placeholder="Please specify" style="display: none;" value="{{ old('job_description_other', $load->job_description_other) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Suggested Vehicle</label>
                                                <select name="suggested_vehicle" id="suggested_vehicle_select" class="form-control" onchange="toggleOtherSuggestedVehicle()">
                                                    <option value="Truck" {{ old('suggested_vehicle', $load->suggested_vehicle) == 'Truck' ? 'selected' : '' }}>Truck</option>
                                                    <option value="Van" {{ old('suggested_vehicle', $load->suggested_vehicle) == 'Van' ? 'selected' : '' }}>Van</option>
                                                    <option value="Trailer" {{ old('suggested_vehicle', $load->suggested_vehicle) == 'Trailer' ? 'selected' : '' }}>Trailer</option>
                                                    <option value="Container" {{ old('suggested_vehicle', $load->suggested_vehicle) == 'Container' ? 'selected' : '' }}>Container</option>
                                                    <option value="Pickup" {{ old('suggested_vehicle', $load->suggested_vehicle) == 'Pickup' ? 'selected' : '' }}>Pickup</option>
                                                    <option value="Other" {{ old('suggested_vehicle', $load->suggested_vehicle) == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <input type="text" name="suggested_vehicle_other" id="suggested_vehicle_other" class="form-control mt-2" placeholder="Please specify" style="display: none;" value="{{ old('suggested_vehicle_other', $load->suggested_vehicle_other) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Packaging</label>
                                                <select name="packaging" id="packaging_select" class="form-control" onchange="toggleOtherPackaging()">
                                                    <option value="Box" {{ old('packaging', $load->packaging) == 'Box' ? 'selected' : '' }}>Box</option>
                                                    <option value="Pallet" {{ old('packaging', $load->packaging) == 'Pallet' ? 'selected' : '' }}>Pallet</option>
                                                    <option value="Crate" {{ old('packaging', $load->packaging) == 'Crate' ? 'selected' : '' }}>Crate</option>
                                                    <option value="Bag" {{ old('packaging', $load->packaging) == 'Bag' ? 'selected' : '' }}>Bag</option>
                                                    <option value="Drum" {{ old('packaging', $load->packaging) == 'Drum' ? 'selected' : '' }}>Drum</option>
                                                    <option value="Other" {{ old('packaging', $load->packaging) == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <input type="text" name="packaging_other" id="packaging_other" class="form-control mt-2" placeholder="Please specify" style="display: none;" value="{{ old('packaging_other', $load->packaging_other) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">No of Items</label>
                                                <input type="number" name="no_of_items" class="form-control" value="{{ old('no_of_items', $load->no_of_items) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gross Weight</label>
                                                <input type="number" step="any" name="gross_weight" class="form-control" value="{{ old('gross_weight', $load->gross_weight) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Weight Unit</label>
                                                <select name="weight_unit" id="weight_unit_select" class="form-control" onchange="toggleOtherWeightUnit()">
                                                    <option value="kg" {{ old('weight_unit', $load->weight_unit) == 'kg' ? 'selected' : '' }}>kg</option>
                                                    <option value="lbs" {{ old('weight_unit', $load->weight_unit) == 'lbs' ? 'selected' : '' }}>lbs</option>
                                                    <option value="Other" {{ old('weight_unit', $load->weight_unit) == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <input type="text" name="weight_unit_other" id="weight_unit_other" class="form-control mt-2" placeholder="Please specify" style="display: none;" value="{{ old('weight_unit_other', $load->weight_unit_other) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Body Type</label>
                                                <select name="body_type" id="body_type_select" class="form-control" onchange="toggleOtherBodyType()">
                                                    <option value="Flatbed" {{ old('body_type', $load->body_type) == 'Flatbed' ? 'selected' : '' }}>Flatbed</option>
                                                    <option value="Box Truck" {{ old('body_type', $load->body_type) == 'Box Truck' ? 'selected' : '' }}>Box Truck</option>
                                                    <option value="Reefer" {{ old('body_type', $load->body_type) == 'Reefer' ? 'selected' : '' }}>Reefer</option>
                                                    <option value="Tanker" {{ old('body_type', $load->body_type) == 'Tanker' ? 'selected' : '' }}>Tanker</option>
                                                    <option value="Curtainside" {{ old('body_type', $load->body_type) == 'Curtainside' ? 'selected' : '' }}>Curtainside</option>
                                                    <option value="Other" {{ old('body_type', $load->body_type) == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <input type="text" name="body_type_other" id="body_type_other" class="form-control mt-2" placeholder="Please specify" style="display: none;" value="{{ old('body_type_other', $load->body_type_other) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Job Type</label>
                                                <select name="job_type" id="job_type_select" class="form-control" onchange="toggleOtherJobType()">
                                                    <option value="Hotshot" {{ old('job_type', $load->job_type) == 'Hotshot' ? 'selected' : '' }}>Hotshot</option>
                                                    <option value="Backload" {{ old('job_type', $load->job_type) == 'Backload' ? 'selected' : '' }}>Backload</option>
                                                    <option value="Other" {{ old('job_type', $load->job_type) == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <input type="text" name="job_type_other" id="job_type_other" class="form-control mt-2" placeholder="Please specify" style="display: none;" value="{{ old('job_type_other', $load->job_type_other) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Length</label>
                                                <input type="number" step="any" name="length" class="form-control" value="{{ old('length', $load->length) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Width</label>
                                                <input type="number" step="any" name="width" class="form-control" value="{{ old('width', $load->width) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Height</label>
                                                <input type="number" step="any" name="height" class="form-control" value="{{ old('height', $load->height) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Dimension Unit</label>
                                                <select name="dimension_unit" id="dimension_unit_select" class="form-control" onchange="toggleOtherDimensionUnit()">
                                                    <option value="mm" {{ old('dimension_unit', $load->dimension_unit) == 'mm' ? 'selected' : '' }}>mm</option>
                                                    <option value="cm" {{ old('dimension_unit', $load->dimension_unit) == 'cm' ? 'selected' : '' }}>cm</option>
                                                    <option value="in" {{ old('dimension_unit', $load->dimension_unit) == 'in' ? 'selected' : '' }}>in</option>
                                                    <option value="ft" {{ old('dimension_unit', $load->dimension_unit) == 'ft' ? 'selected' : '' }}>ft</option>
                                                    <option value="Other" {{ old('dimension_unit', $load->dimension_unit) == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <input type="text" name="dimension_unit_other" id="dimension_unit_other" class="form-control mt-2" placeholder="Please specify" style="display: none;" value="{{ old('dimension_unit_other', $load->dimension_unit_other) }}">
                                            </div>
@push('scripts')
<script>
    function toggleOtherJobDescription() {
        var select = document.getElementById('job_description_select');
        var otherInput = document.getElementById('job_description_other');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
    function toggleOtherSuggestedVehicle() {
        var select = document.getElementById('suggested_vehicle_select');
        var otherInput = document.getElementById('suggested_vehicle_other');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
    function toggleOtherPackaging() {
        var select = document.getElementById('packaging_select');
        var otherInput = document.getElementById('packaging_other');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
    function toggleOtherWeightUnit() {
        var select = document.getElementById('weight_unit_select');
        var otherInput = document.getElementById('weight_unit_other');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
    function toggleOtherBodyType() {
        var select = document.getElementById('body_type_select');
        var otherInput = document.getElementById('body_type_other');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
    function toggleOtherJobType() {
        var select = document.getElementById('job_type_select');
        var otherInput = document.getElementById('job_type_other');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
    function toggleOtherDimensionUnit() {
        var select = document.getElementById('dimension_unit_select');
        var otherInput = document.getElementById('dimension_unit_other');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        toggleOtherJobDescription();
        toggleOtherSuggestedVehicle();
        toggleOtherPackaging();
        toggleOtherWeightUnit();
        toggleOtherBodyType();
        toggleOtherJobType();
        toggleOtherDimensionUnit();
    });
</script>
@endpush
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Notes</label>
                                                <textarea name="notes" class="form-control">{{ old('notes', $load->notes) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4 border-warning">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Documents & Pricing</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Document Name</label>
                                                <input type="text" name="document_name" class="form-control" value="{{ old('document_name', $load->document_name) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Upload Document</label>
                                                <input type="file" name="upload_document" class="form-control">
                                                @if (!empty($load->upload_document))
                                                    <div class="mt-2">
                                                        <a href="{{ asset('storage/' . $load->upload_document) }}" target="_blank">View Current Document</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Distance (km)</label>
                                                <input type="number" step="any" name="distance_km" class="form-control" value="{{ old('distance_km', $load->distance_km) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Distance (miles)</label>
                                                <input type="number" step="any" name="distance_miles" class="form-control" value="{{ old('distance_miles', $load->distance_miles) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Rate per km</label>
                                                <input type="number" step="any" name="rate_per_km" class="form-control" value="{{ old('rate_per_km', $load->rate_per_km) }}">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Rate per mile</label>
                                                <input type="number" step="any" name="rate_per_mile" class="form-control" value="{{ old('rate_per_mile', $load->rate_per_mile) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Currency</label>
                                                <input type="text" name="currency" class="form-control" value="{{ old('currency', $load->currency) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="pending" {{ old('status', $load->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="assigned" {{ old('status', $load->status ?? 'pending') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                                    <option value="in_progress" {{ old('status', $load->status ?? 'pending') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="picked_up" {{ old('status', $load->status ?? 'pending') == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                                                    <option value="in_transit" {{ old('status', $load->status ?? 'pending') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                                    <option value="delivered" {{ old('status', $load->status ?? 'pending') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                    <option value="completed" {{ old('status', $load->status ?? 'pending') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="cancelled" {{ old('status', $load->status ?? 'pending') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
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
                                                <input type="datetime-local" name="assigned_at" class="form-control" value="{{ old('assigned_at', $load->assigned_at) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Completed At</label>
                                                <input type="datetime-local" name="completed_at" class="form-control" value="{{ old('completed_at', $load->completed_at) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-5 py-2 mt-3"><i class="fas fa-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
