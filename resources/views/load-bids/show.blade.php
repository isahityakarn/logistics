@extends('layouts.dashboard')

@section('title', 'Logistics Jobs Prices')
@section('page-title', 'Logistics Jobs Price Management')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Logistics Job Price Details</h5>
                    <div>
                        @if(auth()->user()->user_type === 'admin' || 
                            (auth()->user()->user_type === 'company' && $loadBid->company_id === auth()->id()))
                            <a href="{{ route('load-bids.edit', $loadBid) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                        <a href="{{ route('load-bids.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Price Information</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price ID:</label>
                                <p class="mb-0">
                                    <span class="badge bg-primary">#{{ $loadBid->id }}</span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Price Amount:</label>
                                <p class="mb-0">
                                    <span class="badge bg-success fs-6">
                                        ${{ number_format($loadBid->price, 2) }}
                                    </span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Status:</label>
                                <p class="mb-0">
                                    <span class="badge bg-{{ 
                                        $loadBid->status === 'completed' ? 'success' : 
                                        ($loadBid->status === 'cancelled' ? 'danger' : 
                                        ($loadBid->status === 'in_progress' || $loadBid->status === 'in_transit' ? 'warning' : 
                                        ($loadBid->status === 'delivered' ? 'info' : 'secondary'))) 
                                    }} fs-6">
                                        {{ ucfirst(str_replace('_', ' ', $loadBid->status ?? 'pending')) }}
                                    </span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Created Date:</label>
                                <p class="mb-0">{{ $loadBid->created_at->format('M d, Y H:i A') }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Last Updated:</label>
                                <p class="mb-0">{{ $loadBid->updated_at->format('M d, Y H:i A') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Associated Information</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Logistics Job:</label>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-2">#{{ $loadBid->logisticsJob->id }}</span>
                                    <div>
                                        <p class="mb-0">{{ $loadBid->logisticsJob->job_description ?? 'No description' }}</p>
                                        <small class="text-muted">
                                            Status: <span class="badge bg-info">{{ ucfirst($loadBid->logisticsJob->status) }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Company:</label>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3">
                                        <div class="avatar-title rounded-circle bg-light text-primary fw-bold">
                                            {{ substr($loadBid->company->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $loadBid->company->name }}</h6>
                                        <small class="text-muted">{{ $loadBid->company->email }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Job Details:</label>
                                <div class="small">
                                    <p class="mb-1"><strong>Pickup:</strong> {{ $loadBid->logisticsJob->pickup_location }}</p>
                                    <p class="mb-1"><strong>Delivery:</strong> {{ $loadBid->logisticsJob->delivery_location }}</p>
                                    <p class="mb-0"><strong>Items:</strong> {{ $loadBid->logisticsJob->no_of_items }} items</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="text-muted mb-3">Price Comparison</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Job Original Rate</th>
                                            <th>Distance (KM)</th>
                                            <th>Rate per KM</th>
                                            <th>Company Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                @if($loadBid->logisticsJob->rate_per_km)
                                                    ${{ number_format($loadBid->logisticsJob->rate_per_km * ($loadBid->logisticsJob->distance_km ?? 1), 2) }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $loadBid->logisticsJob->distance_km ?? 'N/A' }}</td>
                                            <td>
                                                @if($loadBid->logisticsJob->rate_per_km)
                                                    ${{ number_format($loadBid->logisticsJob->rate_per_km, 2) }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-success fs-6">
                                                    ${{ number_format($loadBid->price, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->user_type === 'admin' || 
                        (auth()->user()->user_type === 'company' && $loadBid->company_id === auth()->id()))
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-end">
                                <form action="{{ route('load-bids.destroy', $loadBid) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete this price? This action cannot be undone.')">
                                        <i class="fas fa-trash"></i> Delete Price
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
}

.avatar-title {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}
</style>
@endsection
