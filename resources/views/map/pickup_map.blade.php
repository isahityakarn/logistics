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
                    <div id="indiaMap" style="height: 600px; width: 100%;"></div>
                    {{-- <pre>DEBUG: @json($pickupLocations)</pre> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://maps.gomaps.pro/maps/api/js?key=AlzaSyb51YmT6w3FS42W8x9Bhl_sxD4vcwO066L&libraries=places"></script>
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
