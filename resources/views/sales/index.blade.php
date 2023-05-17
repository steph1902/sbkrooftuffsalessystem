@extends('layouts.app')

@section('content')


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    {{-- <h1>Sales List</h1> --}}

    <a href="{{ route('sales.create') }}">Create New Sales</a>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            {{-- &year; --}}
            Daftar Sales
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <!-- Add more table headings for other attributes -->
                        <th>Cek Detail</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                       
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <!-- Add more table headings for other attributes -->
                        <th>Cek Detail</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                       
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->nik }}</td>
                        <td>{{ $sale->nama }}</td>
                        <td>
                            <a href="{{ route('sales.show', $sale->id) }}">Lihat Detail</a>
                        </td>
                        <td>
                            <a href="{{ route('sales.edit', $sale->id) }}">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">Hapus</button>
                            </form>
                        </td>
                                                                                                                                                                 
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection




