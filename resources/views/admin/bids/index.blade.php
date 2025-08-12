@extends('layouts.dashboard')

@section('title', 'Bids')
@section('page-title', 'Bids')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('bids.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Bid</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-list"></i> Bids
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($bids as $bid)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-primary">
                            <div class="card-body py-3 px-3">
                                <div class="row g-0 mb-2">
                                    <div class="col-5 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 110px;"><strong>ID</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-7 ps-2">{{ $bid->id }}</div>
                                </div>
                                <div class="row g-0 mb-2">
                                    <div class="col-5 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 110px;"><strong> Company</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-7 ps-2">{{ $bid->loadRelation->pickup_company ?? '-' }}</div>
                                </div>
                                <div class="row g-0 mb-2">
                                    <div class="col-5 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 110px;"><strong>Pickup </strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-7 ps-2">{{ $bid->loadRelation->pickup_location ?? '-' }}</div>  
                                </div>
                                <div class="row g-0 mb-2">
                                    <div class="col-5 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 110px;"><strong>Delivery </strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-7 ps-2">{{ $bid->loadRelation->delivery_location ?? '-' }}</div>
                                </div>
                                <div class="row g-0 mb-2">
                                    <div class="col-5 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 110px;"><strong>Driver</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-7 ps-2">{{ $bid->driver->name ?? '-' }}</div>
                                </div>
                                <div class="row g-0 mb-2">
                                    <div class="col-5 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 110px;"><strong>Price</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-7 ps-2">{{ $bid->price }}</div>
                                </div>
                                <div class="row g-0 mb-2">
                                    <div class="col-5 ps-0 d-flex align-items-start" style="text-align:left;">
                                        <span style="min-width: 110px;"><strong>Status</strong></span>
                                        <span class="mx-1">:</span>
                                    </div>
                                    <div class="col-7 ps-2"><span class="badge bg-success">{{ ucfirst($bid->status) }}</span></div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 pb-3">
                                <a href="{{ route('bids.show', $bid) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('bids.edit', $bid) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('bids.destroy', $bid) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">No bids found.</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $bids->links() }}
    </div>
</div>
@endsection
