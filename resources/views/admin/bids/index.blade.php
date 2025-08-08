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
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Load</th>
                        <th>Driver</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bids as $bid)
                        <tr>
                            <td>{{ $bid->id }}</td>
                            <td>{{ $bid->loadRelation->id ?? '-' }}</td>
                            <td>{{ $bid->driver->name ?? '-' }}</td>
                            <td>{{ $bid->price }}</td>
                            <td><span class="badge bg-success">{{ ucfirst($bid->status) }}</span></td>
                            <td>
                                <a href="{{ route('bids.show', $bid) }}" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('bids.edit', $bid) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('bids.destroy', $bid) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No bids found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        {{ $bids->links() }}
    </div>
</div>
@endsection
