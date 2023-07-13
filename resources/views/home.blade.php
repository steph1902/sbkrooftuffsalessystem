@extends('layouts.app')

@section('content')
<div class="container">
    

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                    

                    <h2>Assigned Shops:</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    {{-- <table> --}}
                        <tr>
                            <th>ID</th>
                            <th>Shop Name</th>
                            <th>Shop Address</th>
                            <th>Shop Region</th>
                            <th>Shop City</th>
                            <th>Shop District</th>
                            <th>Shop Subdistrict</th>
                            <th>Visit this shop</th>
                            {{-- <th>Shop Google Maps Coord</th> --}}
                        </tr>
                        @foreach ($assignedShops as $shop)
                            <tr>
                                <td>{{ $shop->id }}</td>
                                <td>{{ $shop->shop_name }}</td>
                                <td>{{ $shop->shop_address }}</td>
                                <td>{{ $shop->shop_region }}</td>
                                <td>{{ $shop->shop_city }}</td>
                                <td>{{ $shop->shop_district }}</td>
                                <td>{{ $shop->shop_subdistrict }}</td>
                                {{-- <td><a href="{{ route('shop.details', $shop->id) }}">Visit</a></td> --}}
                                <td><a href="{{ route('visits.create', $shop->id) }}">Visit</a></td>


                            </tr>
                        @endforeach
                    </table>
                </div>



                </div>
            </div>            
        </div>
    </div>


    <div style="padding-top:5%"></div>
    {{--  --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- Sales Visited Shops --}}
                        <h2>Sales Visited Shops</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Shop ID</th>
                                        <th>Shop Name</th>
                                        <th>Visit Date</th>
                                        <th>Location</th>
                                        <th>View Details</th>
                                        <!-- Rest of the table columns -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitedShops as $visit)
                                        <tr>
                                            <td>{{ $visit->id }}</td>
                                            <td>{{ $visit->shop_id }}</td>
                                            <td>{{ $visit->shop_name }}</td>                                            
                                            <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y H:i') }}</td>

                                            <td>
                                                {{$visit->shop_region}},
                                                {{$visit->shop_city}},
                                                {{$visit->shop_district}},
                                                {{$visit->shop_subdistrict}},                                                
                                            </td>
                                            <td>
                                                <a href="{{ route('visits.show', $visit->id) }}">View Details</a>

                                            </td>
                                            <!-- Rest of the table columns -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ $visitedShops->shop_id }} Details
                    </div>
                    <div class="card-body">
                        <h2>Visit Date: {{ $visitedShops->visit_date }}</h2>
                        <p>Location: {{ $visitedShops->location }}</p>
                        <p>Materials: {{ $visitedShops->materials }}</p>
                        <p>Notes: {{ $visitedShops->notes }}</p>
                        <p>Photos:</p>
                        @foreach ($visitedShops->photos as $photo)
                            <img src="{{ asset('storage/' . $photo) }}" alt="Photo">
                        @endforeach
                        <p>Sales ID: {{ $visitedShops->sales_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{--  --}}

    {{-- <div style="padding-top:25%"></div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div style="padding: 5%;"></div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Logout') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div> --}}




    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div style="padding: 5%;"></div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Logout') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  --}}



</div>
@endsection
