@extends('layouts.dashboard')

@section('title', 'Add Bid')
@section('page-title', 'Add Bid')

@section('content')
<div class="container-fluid">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Add Bid</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('bids.index') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('bids.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Load</label>
                        <select name="load_id" class="form-control">
                            <option value="">Select Load</option>
                            @foreach($loads as $load)
                                <option value="{{ $load->id }}" 
                                    {{ (isset($selectedLoadId) && $selectedLoadId == $load->id) ? 'selected' : (old('load_id') == $load->id ? 'selected' : '') }}>
                                    #{{ $load->id }} - {{ $load->pickup_company ?? 'No Company' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Driver</label>
                        <select name="driver_id" class="form-control">
                            <option value="">Select Driver</option>
                            @if(auth()->user()->user_type === 'driver')
                                <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>
                            @else
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="any" name="price" class="form-control" value="{{ old('price') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="assigned" {{ old('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="picked_up" {{ old('status') == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                            <option value="in_transit" {{ old('status') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-5 py-2"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
