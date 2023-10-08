@extends('layouts.app')

@section('content')


<style>
    .table-centered {
  text-align: center;
}

.table-bordered td,
.table-bordered th {
  white-space: nowrap;
}

.table thead th {
  vertical-align: middle;
}

</style>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Filter Data
                </div>
                <div class="card-body">
                    <form action="{{ route('report.index') }}" method="GET">
                        <div class="row">
                            {{-- <div class="col-md-3">
                                <input type="text" name="shop_name" class="form-control" placeholder="Shop Name" value="{{ request('shop_name') }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="sales_name" class="form-control" placeholder="Sales Name" value="{{ request('sales_name') }}">
                            </div> --}}
                            <div class="col-md-6">
                                <input type="text" name="province" class="form-control" placeholder="Province" value="{{ request('province') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
</div>

{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Download Report
                </div>
                <div class="card-body">
                    <a href="{{ route('report.export', request()->query()) }}" class="btn btn-success">Download Excel</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Download Report
                </div>
                <div class="card-body">
                    <a href="{{ route('report.export') }}" class="btn btn-success">Download Report to Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Sales Report</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> --}}
                        <table class="table table-bordered table-centered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Shop Name</th>
                                    <th>Shop Address</th>
                                    <th>Sales Name</th>
                                    <th>Sales Phone Number</th>
                                    <th>Shop City</th>
                                    <th>Photo Toko Depan</th>
                                    <th>Shop Location (Coordinate)</th>
                                    <th>Shop Last Visit</th>
                                    <th>Shop Materials</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach($reportData as $report)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $report->shop_name }}</td>
                                    <td>{{ $report->shop_address }}</td>
                                    <td>{{ $report->nama }}</td>
                                    <td>{{ $report->nomor_handphone }}</td>
                                    <td>{{ $report->shop_city }}</td>
                                    <td>
                                        
                                      
                                            <a href="{{ asset('storage/' . $report->photo) }}" target="_blank">
                                                Click to Enlarge or View <br>

                                                {{-- <img src="{{ asset('storage/' . $report->photo) }}" alt="Photo Toko Depan"> --}}
                                                <img src="{{ asset('storage/' . $report->photo) }}" alt="Photo Toko Depan" style="width: 100px; height: auto;">

                                            </a>
                                        
                                        
                                    
                                    </td>
                                    <td>
                                        
                                        {{ $report->location }}
                                        {{-- <br>
                                        <a href="#" onclick="showMap('{{ $report->location }}')">
                                            {{ $report->location }}
                                        </a>

                                        <br>
                                        
                                            <a href="#" onclick="showMap('{{ $report->location }}')">
                                                {{ $report->location }}
                                            </a>
                                        
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="#" onclick="showMap('{{ $report->location }}')">
                                            View Map
                                        </a>

                                        <br>
                                        <a href="#" onclick="showMap('{{ $report->location }}')">
                                            View Map
                                        </a>
                                        <br>
                                        <a href="#" onclick="showMap('{{ $report->location }}'); return false;">
                                            View Map
                                        </a> --}}
                                        
                                    
                                    </td>                                    
                                    <td>{{ \Carbon\Carbon::parse($report->created_at)->format('D, d M Y H:i') }}</td>
                                    <td>{{ $report->materials }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function showMap(location) {
        // Extract the latitude and longitude from the coordinate value
        var coordinates = location.split(',');

        // Get the latitude and longitude values
        var latitude = parseFloat(coordinates[1].split('=')[1]);
        var longitude = parseFloat(coordinates[0].split('=')[1]);

        // Create a LonLat object with the latitude and longitude
        var lonLat = new OpenLayers.LonLat(longitude, latitude).transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
        );

        // Create a marker and add it to the marker layer
        var marker = new OpenLayers.Marker(lonLat);
        markerLayer.addMarker(marker);

        // Zoom the map to the marker's location
        map.setCenter(lonLat, 16); // Adjust the zoom level as needed

        // Open the map in a new tab
        var mapUrl = map.getFullRequestString({
            map_projection: 'EPSG:3857',
            layers: 'OSM',
            format: 'png',
            height: 600,
            width: 800,
            transparent: true
        });
        window.open(mapUrl, '_blank');
    }
</script>




@endsection
