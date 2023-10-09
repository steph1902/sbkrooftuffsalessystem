@extends('layouts.app')
@section('content')

@php
use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Sales</title>
    <style>
        /* CSS untuk warna biru pada laporan */
        /* .blue-cell {
            background-color: blue;
        } */
         /* CSS untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* CSS untuk warna biru pada laporan */
        .blue-cell {
            background-color: blue !important;
        }
    </style>
</head>
<body>

    
    

    {{--  --}}
    {{-- <br><hr><hr><br><br> --}}
    {{--  --}}
    <form action="{{ route('sales-report') }}" method="get">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}"{{ $i == $bulan ? ' selected' : '' }}>{{ Carbon::create()->month($i)->format('F') }}</option>
            @endfor
        </select>
        <label for="tahun">Pilih Tahun:</label>
        <select name="tahun" id="tahun">
            @for ($i = date('Y'); $i >= 2022; $i--)
                <option value="{{ $i }}"{{ $i == $tahun ? ' selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Tampilkan Laporan</button>
    </form>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <p>Saat ini, laporan untuk bulan:
                        <h4>{{ Carbon::create()->month($bulan)->format('F') }} {{ $tahun }} </h4>
                    </p>
                </p>
            </div>
        </div>
    </div>
    {{--  --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{url('home')}}"> Cek daftar toko </a>
            </div>
            <div class="col-md-12">                
                <a href="{{ route('visits.showVisitedStoreData') }}">Cek daftar toko yang sudah di visit</a>
            </div>
            {{-- <div class="col-md-12">                
                <a href="{{ route('sales-report') }}">Cek laporan toko yang sudah di visit</a>
            </div> --}}
        </div>
    </div>

    <br>
    <hr>
    <br>

    {{-- <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Toko yang Belum Dikunjungi (Oktober)</h5>
            <p class="card-text">{{ $totalTokoBelumDikunjungi }} toko</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Toko yang Sudah Dikunjungi (Oktober)</h5>
            <p class="card-text">{{ $totalTokoSudahDikunjungi }} toko</p>
        </div>
    </div> --}}
    

    <hr>
    <br>



    <div class="table-responsive">

        
    

    {{-- <table border="1"> --}}
    {{-- <table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal</th>
                @foreach($shops as $shop)
                    <th>{{ $shop->shop_name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($dates as $date)
                <tr>
                    <td>{{ $date }}</td>
                    @foreach($shops as $shop)
                        <td class="{{ $report[$date][$shop->shop_name] ? 'blue-cell' : '' }}"></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>

    </table> --}}

    <table border="1">
        <thead>
            <tr>
                <th>Tanggal</th>
                @foreach($dates as $date)
                    <th>{{ $date }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->shop_name }}</td>
                    @foreach($dates as $date)
                        <td class="{{ $report[$date][$shop->shop_name] ? 'blue-cell' : '' }}"></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    

    </div>

</body>
</html>



@endsection