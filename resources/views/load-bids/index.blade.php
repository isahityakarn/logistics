@extends('layouts.dashboard')

@section('title', 'Load Bids')
@section('page-title', 'Load Bid Management')

@section('content')
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h3 mb-0 text-gray-800">
                            @if (auth()->user()->user_type === 'driver')
                                <i class="bi bi-currency-dollar text-primary"></i>
                                Load Bids
                            @else
                                <i class="bi bi-currency-dollar text-primary"></i>
                                Load Bids
                            @endif
                        </h2>
                        <p class="text-muted mb-0">
                            @if (auth()->user()->user_type === 'admin')
                                Manage pricing for all logistics jobs
                            @elseif(auth()->user()->user_type === 'company')
                                Manage your company's job pricing
                            @else
                                View pricing information for your assigned jobs
                            @endif
                        </p>
                    </div>
                    @if (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'company')
                        <div>
                            @php
                                $createRoute = 'load-bids.create';
                            @endphp
                            <a href="{{ route($createRoute) }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-plus-circle me-2"></i>
                                Add New Price
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Prices
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $prices->total() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-list-ul fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Average Price
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ number_format($prices->avg('price') ?? 0, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-graph-up fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Highest Price
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ number_format($prices->max('price') ?? 0, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-arrow-up fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Lowest Price
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ number_format($prices->min('price') ?? 0, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Job Prices List</h6>
                    <div class="d-flex align-items-center">
                        <span class="text-muted me-3">{{ $prices->count() }} of {{ $prices->total() }} entries</span>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($prices->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="py-3 px-4">
                                        <i class="bi bi-hash me-1"></i>
                                        ID
                                    </th>
                                    <th class="py-3 px-4">
                                        <i class="bi bi-box-seam me-1"></i>
                                        Job Details
                                    </th>
                                    <th class="py-3 px-4">
                                        <i class="bi bi-building me-1"></i>
                                        Company
                                    </th>
                                    <th class="py-3 px-4">
                                        <i class="bi bi-currency-dollar me-1"></i>
                                        Price
                                    </th>
                                    <th class="py-3 px-4">
                                        <i class="bi bi-flag me-1"></i>
                                        Status
                                    </th>
                                    <th class="py-3 px-4">
                                        <i class="bi bi-calendar me-1"></i>
                                        Created
                                    </th>
                                    <th class="py-3 px-4 text-center">
                                        <i class="bi bi-gear me-1"></i>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prices as $price)
                                    <tr class="border-bottom">
                                        <td class="py-3 px-4">
                                            <span class="badge bg-primary fs-6">#{{ $price->id }}</span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded p-2 me-3">
                                                    <i class="bi bi-box text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">
                                                        <span
                                                            class="badge bg-info me-2">#{{ $price->logisticjob_id }}</span>
                                                        {{ Str::limit($price->logisticsJob->job_description ?? 'No description', 40) }}
                                                    </h6>
                                                    <div class="small text-muted">
                                                        <i class="bi bi-geo-alt me-1"></i>
                                                        {{ Str::limit($price->logisticsJob->pickup_location ?? 'N/A', 30) }}
                                                        <i class="bi bi-arrow-right mx-1"></i>
                                                        {{ Str::limit($price->logisticsJob->delivery_location ?? 'N/A', 30) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3">
                                                    <span class="avatar-initials">
                                                        {{ substr($price->company->name, 0, 2) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $price->company->name }}</h6>
                                                    <small class="text-muted">{{ $price->company->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="price-display">
                                                <span class="h5 mb-0 text-success fw-bold">
                                                    ${{ number_format($price->price, 2) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="badge bg-{{ $price->status === 'completed'
                                                    ? 'success'
                                                    : ($price->status === 'cancelled'
                                                        ? 'danger'
                                                        : ($price->status === 'in_progress' || $price->status === 'in_transit'
                                                            ? 'warning'
                                                            : ($price->status === 'delivered'
                                                                ? 'info'
                                                                : 'secondary'))) }} fs-6">
                                                {{ ucfirst(str_replace('_', ' ', $price->status ?? 'pending')) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $price->created_at->format('M d, Y') }}
                                                <br>
                                                <small
                                                    class="text-muted">{{ $price->created_at->format('h:i A') }}</small>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="btn-group" role="group">
                                                @php
                                                    $showRoute =
                                                        auth()->user()->user_type === 'admin'
                                                            ? 'load-bids.show'
                                                            : (auth()->user()->user_type === 'company'
                                                                ? 'load-bids.show'
                                                                : 'load-bids.show');
                                                @endphp
                                                <a href="{{ route($showRoute, $price) }}"
                                                    class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip"
                                                    title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                @if (auth()->user()->user_type === 'admin' ||
                                                        (auth()->user()->user_type === 'company' && $price->company_id === auth()->id()))
                                                    @php
                                                        $editRoute = 'load-bids.edit';
                                                        $destroyRoute = 'load-bids.destroy';
                                                    @endphp
                                                    <a href="{{ route($editRoute, $price) }}"
                                                        class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip"
                                                        title="Edit Price">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <form action="{{ route($destroyRoute, $price) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this price?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            data-bs-toggle="tooltip" title="Delete Price">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($prices->hasPages())
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-center">
                                {{ $prices->links() }}
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="bi bi-currency-dollar display-1 text-muted mb-3"></i>
                            @if (auth()->user()->user_type === 'driver')
                                <h4 class="text-muted mb-3">No job prices found</h4>
                                <p class="text-muted mb-4">Pricing information will appear here when you are assigned jobs
                                    with pricing details.</p>
                            @else
                                <h4 class="text-muted mb-3">No prices found</h4>
                                <p class="text-muted mb-4">Start by creating your first logistics job price to track and
                                    manage pricing.</p>
                                @if (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'company')
                                    @php
                                        $createRoute =
                                            auth()->user()->user_type === 'admin'
                                                ? 'admin.load-bids.create'
                                                : 'company.load-bids.create';
                                    @endphp
                                    <a href="{{ route($createRoute) }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Add First Price
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }

        .avatar-circle {
            width: 45px;
            height: 45px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-initials {
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }

        .price-display {
            text-align: center;
            padding: 8px 12px;
            background: rgba(28, 200, 138, 0.1);
            border-radius: 8px;
            border-left: 4px solid #1cc88a;
        }

        .empty-state {
            padding: 3rem 2rem;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
            transition: background-color 0.15s ease-in-out;
        }

        .btn-group .btn {
            margin: 0 2px;
        }

        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .badge {
            font-size: 0.8rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection
