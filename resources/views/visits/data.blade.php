@extends('layouts.table')
@section('content')


{{-- 
    <div class="container">        
        <h3>Welcome, <b> {{ $user->name }}</b> </h3>        
    </div> --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{url('home')}}"> Cek daftar toko </a>
            </div>
            {{-- <div class="col-md-12">                
                <a href="{{ route('visits.showVisitedStoreData') }}">Cek daftar toko yang sudah di visit</a>
            </div> --}}
            <div class="col-md-12">                
                <a href="{{ url('sales-report/?bulan=10&tahun=2023') }}">Cek laporan toko yang sudah di visit</a>
            </div>
        </div>
    </div>

    <br>
    <hr>
    <br>
    

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Toko</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                {{-- @if ($shops->count() > 0) --}}

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Shop ID</th>
                                <th>Shop Name</th>
                                <th>Visit Date</th>
                                <th>Location</th>
                                <th>View Details</th>                            
                                {{-- <th>Nama Toko</th>
                                <th>Alamat Toko</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>                        
                                <th>Nama PIC</th>
                                <th>No. Handphone PIC</th>
                                <th>Action</th> --}}                                
                            </tr>
                        </thead>
                        <tfoot>                            
                            {{-- @foreach ($visitedShops as $visit) --}}
                                <tr>
                                    <th>ID</th>
                                    <th>Shop ID</th>
                                    <th>Shop Name</th>
                                    <th>Visit Date</th>
                                    <th>Location</th>
                                    <th>View Details</th>     
                                    {{-- <td>{{ $shop->shop_name }}</td>
                                    <td>{{ $shop->shop_address }}</td>
                                    <td>{{ $shop->provinsi }}</td>
                                    <td>{{ $shop->kota }}</td>
                                    <td>{{ $shop->kecamatan }}</td>
                                    <td>{{ $shop->kelurahan }}</td>
                                    <td>{{ $shop->nama_pic }}</td>
                                    <td>{{ $shop->nomor_hp_pic }}</td>
                                    <td><a href="{{ route('visits.create', $shop->id) }}">Visit</a></td> --}}
                                    {{-- <td>Visit toko</td> --}}
                                </tr>
                            {{-- @endforeach --}}
                        </tfoot>
                        <tbody>

                            @foreach ($visitedShops as $visit)
                                <tr>
                                    <td>{{ $visit->id }}</td>
                                    <td>{{ $visit->shop_id }}</td>
                                    <td>{{ $visit->shop_name }}</td>                                            
                                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y H:i') }}</td>

                                    <td>
                                        {{$visit->provinsi}},
                                        {{$visit->kota}},
                                        {{$visit->kecamatan}},
                                        {{$visit->kelurahan}},                                                
                                    </td>
                                    <td>
                                        <a href="{{ route('visits.show', $visit->id) }}">View Details</a>

                                    </td>
                                    <!-- Rest of the table columns -->
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                {{-- @endif --}}


            </div>
        </div>
    </div>





@endsection