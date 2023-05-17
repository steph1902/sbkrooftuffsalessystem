@extends('layouts.app')

@section('content')
<div class="container">
    

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                    <!-- sales.dashboard.blade.php -->

                    {{-- <h1>Sales Dashboard</h1>

                    <h2>Sales Information:</h2> --}}
                    {{-- <table>
                        <tr>
                            <th>ID</th>
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->nik }}</td>
                            <td>{{ $sale->nama }}</td>
                            <td>{{ $sale->email }}</td>
                        </tr>
                        @endforeach
                    </table> --}}

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


    <div style="padding-top:25%"></div>
    {{--  --}}

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
