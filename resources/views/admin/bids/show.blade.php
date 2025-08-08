@extends('layouts.dashboard')

@section('title', 'Bid Details')
@section('page-title', 'Bid Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Bid Details</h2>
        <div>
            <a href="{{ route('bids.index') }}" class="btn btn-secondary me-2">Back to List</a>
            <a href="{{ route('bids.edit', $bid) }}" class="btn btn-warning me-2">Edit</a>
            <form action="{{ route('bids.destroy', $bid) }}" method="POST" style="display:inline-block;">
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
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Assignment Info</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">ID</dt>
                        <dd class="col-sm-7">{{ $bid->id }}</dd>
                        <dt class="col-sm-5">Load</dt>
                        <dd class="col-sm-7">{{ $bid->loadRelation->id ?? '-' }}</dd>
                        <dt class="col-sm-5">Driver</dt>
                        <dd class="col-sm-7">{{ $bid->driver->name ?? '-' }}</dd>
                        <dt class="col-sm-5">Price</dt>
                        <dd class="col-sm-7">{{ $bid->price }}</dd>
                        <dt class="col-sm-5">Status</dt>
                        <dd class="col-sm-7">{{ ucfirst($bid->status) }}</dd>
                        <dt class="col-sm-5">Created At</dt>
                        <dd class="col-sm-7">{{ $bid->created_at }}</dd>
                        <dt class="col-sm-5">Updated At</dt>
                        <dd class="col-sm-7">{{ $bid->updated_at }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
