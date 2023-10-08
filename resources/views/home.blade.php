@extends('layouts.app')
@section('content')

<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
    }

    .pagination li {
        margin: 0 5px;
        display: flex;
        align-items: center;
    }

    .pagination a {
        color: #333;
        text-decoration: none;
    }

    .pagination a:hover {
        color: #007BFF;
    }
    .pagination-link {
    display: none !important;
}
</style>


    <div class="container">
        <h1>Welcome, {{ $user->name }}</h1>

        <h2>Your Shops:</h2>
        @if ($shops->count() > 0)
            {{-- <table class="table"> --}}
                {{-- <thead> --}}
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Shop Name</th>
                        <th>Shop Address</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Sub-district</th>
                        <th>Urban Village</th>
                        <th>PIC Name</th>
                        <th>PIC Phone Number</th>
                        <!-- Tambahkan kolom tambahan sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shops as $shop)
                        <tr>
                            <td>{{ $shop->shop_name }}</td>
                            <td>{{ $shop->shop_address }}</td>
                            <td>{{ $shop->provinsi }}</td>
                            <td>{{ $shop->kota }}</td>
                            <td>{{ $shop->kecamatan }}</td>
                            <td>{{ $shop->kelurahan }}</td>
                            <td>{{ $shop->nama_pic }}</td>
                            <td>{{ $shop->nomor_hp_pic }}</td>
                            <!-- Tambahkan sel untuk kolom tambahan sesuai kebutuhan -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

           

            <div class="d-flex justify-content-center">
                {{ $shops->links() }}
            </div>



        @else
            <p>You don't have any shops.</p>
        @endif
    </div>
@endsection
