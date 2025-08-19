@extends('layouts.dashboard')

@section('title', 'Pickup Locations Map')
@section('page-title', 'Pickup Locations Map')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Pickup Locations on Indian Map</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('map.pickup') }}" class="mb-3">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="pickup_location" class="form-label">Pickup location</label>
                                <input type="text" id="pickup_location" name="pickup_location" value="{{ request('pickup_location') }}" class="form-control" placeholder="e.g., Mumbai">
                            </div>
                            <div class="col-md-4">
                                <label for="delivery_location" class="form-label">Drop location</label>
                                <input type="text" id="delivery_location" name="delivery_location" value="{{ request('delivery_location') }}" class="form-control" placeholder="e.g., Delhi">
                            </div>
                            <div class="col-md-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('map.pickup') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div id="indiaMap" style="height: 600px; width: 100%;"></div>
                    {{-- <pre>DEBUG: @json($pickupLocations)</pre> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
   <script src="https://maps.gomaps.pro/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script>
        function initMap() {
            // Center of India
            var indiaCenter = { lat: 22.5937, lng: 78.9629 };
            var map = new google.maps.Map(document.getElementById('indiaMap'), {
                zoom: 5,
                center: indiaCenter
            });

            var locations = @json($pickupLocations);
            locations.forEach(function(location) {
                if (location.pickup_latitude && location.pickup_longitude) {
                    var marker = new google.maps.Marker({
                        position: { lat: parseFloat(location.pickup_latitude), lng: parseFloat(location.pickup_longitude) },
                        map: map,
                        title: location.pickup_location
                    });
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
    </script>
@endpush
