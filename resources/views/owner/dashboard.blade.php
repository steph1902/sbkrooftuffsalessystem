{{-- <h1>SUPERADMIN OWNER DASHBOARD</h1> --}}

<!-- dashboard.blade.php -->

@extends('layouts.superadmin')

@section('content')
    <!-- Your owner dashboard content here -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Owner Dashboard</div>

                    <div class="card-body">
                        Welcome, {{ Auth::user()->name }}!

                        <br><hr><br>

                        <!-- Add this logout form -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
